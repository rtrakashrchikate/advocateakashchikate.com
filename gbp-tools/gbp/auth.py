"""OAuth for the Business Profile APIs.

client_secret.json (a "Desktop app" OAuth client from Google Cloud Console)
and the saved token live in gbp-tools/.secrets/, which git ignores.
"""

from __future__ import annotations

from pathlib import Path

SCOPES = ["https://www.googleapis.com/auth/business.manage"]
SECRETS = Path(__file__).resolve().parent.parent / ".secrets"
CLIENT_SECRET = SECRETS / "client_secret.json"
TOKEN = SECRETS / "token.json"


def session(interactive: bool = True):
    from google.auth.transport.requests import AuthorizedSession, Request
    from google.oauth2.credentials import Credentials

    creds = None
    if TOKEN.exists():
        creds = Credentials.from_authorized_user_file(str(TOKEN), SCOPES)
    if creds and creds.expired and creds.refresh_token:
        creds.refresh(Request())
    if not creds or not creds.valid:
        if not interactive:
            raise SystemExit("Not signed in. Run: python -m gbp login")
        if not CLIENT_SECRET.exists():
            raise SystemExit(
                f"Missing {CLIENT_SECRET}.\nDownload a Desktop-app OAuth client "
                "from Google Cloud Console and save it there (README step 2)."
            )
        from google_auth_oauthlib.flow import InstalledAppFlow

        flow = InstalledAppFlow.from_client_secrets_file(str(CLIENT_SECRET), SCOPES)
        creds = flow.run_local_server(port=0, open_browser=True)
    SECRETS.mkdir(exist_ok=True)
    TOKEN.write_text(creds.to_json())
    try:
        TOKEN.chmod(0o600)
    except OSError:
        pass
    return AuthorizedSession(creds)
