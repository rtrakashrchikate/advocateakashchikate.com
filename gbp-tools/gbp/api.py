"""Thin REST client for the Google Business Profile APIs.

Google retired most of the old "Google My Business API v4" between 2021 and
2023. What is left, and what this module uses:

  * Account Management API v1   - list accounts
  * Business Information API v1 - list locations (offices)
  * My Business API v4          - reviews and local posts (still the only home
                                   for these two features)

The v4 samples at github.com/google/google-my-business-samples (branch v4)
build a client from a downloaded discovery document. The v4 surface is now so
small that plain HTTPS calls are simpler and need no discovery file.
"""

from __future__ import annotations

from typing import Any, Iterator

ACCOUNTS_URL = "https://mybusinessaccountmanagement.googleapis.com/v1/accounts"
INFO_URL = "https://mybusinessbusinessinformation.googleapis.com/v1"
V4_URL = "https://mybusiness.googleapis.com/v4"

LOCATION_READ_MASK = "name,title,storefrontAddress,websiteUri,metadata"

STARS = {"ONE": 1, "TWO": 2, "THREE": 3, "FOUR": 4, "FIVE": 5}


class ApiError(RuntimeError):
    pass


class GbpClient:
    """Wraps an authorised `requests`-style session (google.auth AuthorizedSession)."""

    def __init__(self, session: Any):
        self.session = session

    # -- plumbing ---------------------------------------------------------

    def _request(self, method: str, url: str, **kwargs) -> dict:
        resp = self.session.request(method, url, timeout=30, **kwargs)
        if resp.status_code >= 400:
            hint = ""
            if resp.status_code == 403:
                hint = (
                    "\nHint: 403 usually means Google has not approved Business "
                    "Profile API access for this Cloud project yet, or the API "
                    "is not enabled. See gbp-tools/README.md, step 1."
                )
            elif resp.status_code == 429:
                hint = "\nHint: quota is 0 until Google approves API access."
            raise ApiError(f"{method} {url} -> {resp.status_code}: {resp.text[:500]}{hint}")
        return resp.json() if resp.content else {}

    def _paged(self, url: str, key: str, params: dict | None = None) -> Iterator[dict]:
        params = dict(params or {})
        while True:
            data = self._request("GET", url, params=params)
            yield from data.get(key, [])
            token = data.get("nextPageToken")
            if not token:
                return
            params["pageToken"] = token

    # -- accounts and locations --------------------------------------------

    def accounts(self) -> list[dict]:
        return list(self._paged(ACCOUNTS_URL, "accounts"))

    def locations(self, account: str) -> list[dict]:
        """`account` is "accounts/123". Returned names look like "locations/456"."""
        url = f"{INFO_URL}/{account}/locations"
        return list(self._paged(url, "locations", {"readMask": LOCATION_READ_MASK, "pageSize": 100}))

    # -- reviews (v4) ------------------------------------------------------

    @staticmethod
    def v4_location(account: str, location: str) -> str:
        """Combine "accounts/1" + "locations/2" into the v4 path "accounts/1/locations/2"."""
        loc_id = location.split("/")[-1]
        return f"{account}/locations/{loc_id}"

    def reviews(self, v4_location: str) -> list[dict]:
        url = f"{V4_URL}/{v4_location}/reviews"
        return list(self._paged(url, "reviews", {"pageSize": 50}))

    def reply_to_review(self, review_name: str, comment: str) -> dict:
        """`review_name` is the full v4 name: accounts/../locations/../reviews/.."""
        return self._request("PUT", f"{V4_URL}/{review_name}/reply", json={"comment": comment})

    # -- local posts (v4) --------------------------------------------------

    def create_post(self, v4_location: str, body: dict) -> dict:
        return self._request("POST", f"{V4_URL}/{v4_location}/localPosts", json=body)

    def posts(self, v4_location: str) -> list[dict]:
        url = f"{V4_URL}/{v4_location}/localPosts"
        return list(self._paged(url, "localPosts", {"pageSize": 100}))
