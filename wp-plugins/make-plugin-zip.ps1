Add-Type -AssemblyName System.IO.Compression
Add-Type -AssemblyName System.IO.Compression.FileSystem

$zipPath   = 'C:\Users\rtrak\Desktop\Website\wp-plugins\akc-data-importer.zip'
$pluginDir = 'C:\Users\rtrak\Desktop\Website\wp-plugins\akc-data-importer'

if (Test-Path $zipPath) { Remove-Item $zipPath }

$stream  = [System.IO.File]::Open($zipPath, [System.IO.FileMode]::Create)
$archive = New-Object System.IO.Compression.ZipArchive($stream, [System.IO.Compression.ZipArchiveMode]::Create)

Get-ChildItem -Path $pluginDir -Recurse -File | ForEach-Object {
    $relativePath = $_.FullName.Substring($pluginDir.Length + 1).Replace('\', '/')
    $entryName    = 'akc-data-importer/' + $relativePath
    $entry        = $archive.CreateEntry($entryName, [System.IO.Compression.CompressionLevel]::Optimal)
    $entryStream  = $entry.Open()
    $fileStream   = [System.IO.File]::OpenRead($_.FullName)
    $fileStream.CopyTo($entryStream)
    $fileStream.Close()
    $entryStream.Close()
    Write-Host "Added: $entryName"
}

$archive.Dispose()
$stream.Close()
Write-Host "ZIP created successfully"
