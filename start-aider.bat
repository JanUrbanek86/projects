@echo off
echo ================================================
echo   Aider AI Coding Assistant
echo   Model: DeepSeek R1 Qwen3-8B
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

REM Spust Aider s DeepSeek R1
cd /d C:\xampp\htdocs\projects
echo Spoustim Aider...
echo Model: deepseek-r1-0528-qwen3-8b
echo Edit format: whole
echo URL: http://localhost:8080
echo.

C:\Users\janurbanek\AppData\Local\Programs\Python\Python312\Scripts\aider.exe ^
    --browser ^
    --model openai/deepseek-r1-0528-qwen3-8b ^
    --openai-api-base http://localhost:1234/v1 ^
    --openai-api-key lm-studio ^
    --edit-format whole ^
    --encoding utf-8 ^
    --no-attribute-author ^
    --auto-commits ^
    --yes-always

pause