---
name: prod-access
description: Access the 12psb.ru production server and verify deploys. Use when the user asks about production, the live site, server files, logs, SSH, or whether a master deploy landed.
---

# Production access for 12psb.ru

Use this when checking or debugging the live site. Deploy only through the GitHub Actions pipeline. Do not pull, migrate, or edit files on the server unless the user explicitly asks for that.

## Access

Connect with the SSH alias already configured on the operator machine:

```bash
ssh sta
```

The site checkout is:

```text
/var/www/u6133241/data/www/12psb.ru
```

Public URL: https://12psb.ru

The alias is `Host sta` in the operator SSH config. It is not stored in this repository. If `ssh sta` fails with `Could not resolve hostname sta`, the current machine has no such host entry. Do not guess a hostname, IP, user, or key. Say that the alias is missing here.

Prefer non-interactive commands:

```bash
ssh -o BatchMode=yes sta 'cd /var/www/u6133241/data/www/12psb.ru && git rev-parse --short HEAD && git log -1 --oneline && git status -sb'
```

## Deploy

Production updates come from `.github/workflows/deploy-prod.yml`.

- Trigger: push to `master`.
- The workflow SSHes to the server and runs, in the site directory:
  1. `git fetch origin master`
  2. `git checkout master`
  3. `git pull --ff-only origin master`
  4. `php7.4 composer.phar install --no-interaction --no-progress --prefer-dist --optimize-autoloader`
  5. `php7.4 yii migrate --interactive=0`
- A pull request does not deploy. Merging to `master` does.
- Frontend assets are committed build output in `frontend/assets/dist/prod`. The pipeline does not run `gulp` or `npm`. Rebuild assets locally and commit them before merging when JS or CSS changed.

## What to do on the server

Default to read-only checks.

```bash
ssh sta 'cd /var/www/u6133241/data/www/12psb.ru && git log -1 --oneline && git status -sb'
```

Yii runtime files live under `frontend/runtime` and `backend/runtime` inside the site directory. They are not in git.

After a deploy, confirm the live site is serving the new assets. The HTML references `/assets/<hash>/js/vendor.min.js` and `all.min.css`. Compare file size or contents with `frontend/assets/dist/prod` in the deployed commit. Yii caches published assets; a new `?v=` query is a sign the files were republished.

## Do not

- Do not commit secrets, dump `.env`, or print SSH private keys.
- Do not restart PHP, nginx, or MySQL unless the user asks.
- Do not run `composer install` or `yii migrate` by hand. The pipeline does that.
- Do not force-push or reset `master` on the server. The deploy uses `git pull --ff-only`.
