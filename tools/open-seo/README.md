# OpenSEO v0.1.26 (prebuilt release)

A copy of the official release of [every-app/open-seo](https://github.com/every-app/open-seo), an open-source SEO tool (keyword research, rank tracking, backlinks, site audits, AI visibility). MIT licensed.

- File: `everyapp-release-v0.1.26.tar.gz`, downloaded 10 Nov 2026 from
  https://github.com/every-app/open-seo/releases/download/v0.1.26/everyapp-release.tar.gz
- SHA-256: `64c6c3b283a088861d5f71c3ed1b7ab087ad8431c406f1f3b8a5ab0db5e025d8`
- Contents: a prebuilt Cloudflare Workers bundle (app + audit worker) and database migrations. It is not source code and is not part of the website.

## It is not running anywhere yet

OpenSEO is a web app that has to be deployed. To use it you need:

1. **A Cloudflare account** with R2 switched on (free plan works, but R2 asks for a payment card; site audits stop at about 40 pages on the free plan).
2. **A DataForSEO account and API key.** This is where the SEO data comes from. New accounts get $1 of credit; the minimum top-up after that is $50.
3. **A deploy from a computer** (Node 22.6+, pnpm): clone the source repo, `pnpm alchemy login`, set `DATAFORSEO_API_KEY` in `.env.selfhost`, then `pnpm deploy:selfhost --yes`. Full steps: `docs/SELF_HOSTING_CLOUDFLARE.md` in the source repo.
4. **Create the admin account immediately** at the URL the deploy prints. Until the first account exists, anyone who finds the URL can claim it.

No-computer alternative: the hosted version at openseo.so ($10/month plus data usage).
