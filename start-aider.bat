@echo off
echo ================================================
echo   Aider AI Coding Assistant
echo ================================================
echo.

REM Zkontroluj LM Studio
curl -s http://localhost:1234/v1/models >nul 2>&1
if errorlevel 1 (
    echo [CHYBA] LM Studio nebezi!
    echo Prosim spust LM Studio a nahraj model.
    echo.
    pause
    exit /b 1
)

echo [OK] LM Studio bezi
echo.

REM Spust Aider
cd /d C:\xampp\htdocs\projects
echo Spoustim Aider...
echo URL: http://localhost:8080
echo.
C:\Users\janurbanek\AppData\Local\Programs\Python\Python312\Scripts\aider.exe --browser

pause