Set WinScriptHost = CreateObject("WScript.Shell")
WinScriptHost.Run Chr(34) & "C:\Apache24\htdocs\EMS\attendance-mark-in-cron-job.bat" & Chr(34), 0
Set WinScriptHost = Nothing