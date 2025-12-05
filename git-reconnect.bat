@echo off
echo ================================================
echo   Git Reconnect - Nastaveni po restartu
echo ================================================
echo.

cd /d C:\xampp\htdocs\projects

echo [1/4] Kontroluji Git konfiguraci...
git config user.name "Jan Urbanek"
git config user.email "tvuj@email.cz"
echo OK - Git user nastaven
echo.

echo [2/4] Kontroluji remote repository...
git remote -v
echo.

echo [3/4] Pulluji zmeny z GitHubu...
git pull origin master
echo.

echo [4/4] Testuji push...
echo test > .git-test-file
git add .git-test-file
git commit -m "test: git connection after restart"
git push origin master
git rm .git-test-file
git commit -m "chore: remove test file"
git push origin master
echo.

echo ================================================
echo   Git reconnect HOTOVO!
echo ================================================
echo.
pause
