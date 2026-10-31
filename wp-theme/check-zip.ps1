Add-Type -AssemblyName System.IO.Compression.FileSystem
$zip = [System.IO.Compression.ZipFile]::OpenRead('C:\Users\rtrak\Desktop\Website\wp-theme\akashchikate.zip')
$zip.Entries | ForEach-Object { Write-Host $_.FullName }
$zip.Dispose()
