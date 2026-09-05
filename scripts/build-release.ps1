[CmdletBinding()]
param()
$ErrorActionPreference = 'Stop'
$projectRoot = Split-Path $PSScriptRoot -Parent
$themeRelative = 'wordpress/wp-content/themes/necmar-rijschool'
$themeRoot = Join-Path $projectRoot $themeRelative
$releaseRoot = Join-Path $projectRoot 'artifacts'
if (-not (Test-Path -LiteralPath (Join-Path $themeRoot 'style.css'))) { throw 'Thema ontbreekt.' }
foreach ($file in Get-ChildItem -LiteralPath $themeRoot -Recurse -Force -File) {
    if ($file.Name -match '^\.env|^wp-config\.php$|\.(sql|pem|key|log|zip)$') {
        throw "Verboden releasebestand: $($file.Name)"
    }
    if ($file.Extension -eq '.php') {
        & php -l $file.FullName
        if ($LASTEXITCODE -ne 0) { throw "PHP-controle mislukt: $($file.Name)" }
    }
}
$links = @(Get-ChildItem -LiteralPath $themeRoot -Recurse -Force | Where-Object { $_.LinkType })
if ($links.Count) { throw 'Symbolische links niet toegestaan.' }
$revision = & git -C $projectRoot rev-parse --verify HEAD
if ($LASTEXITCODE -ne 0) { throw 'Maak eerst een Git-commit.' }
$changes = & git -C $projectRoot status --porcelain -- $themeRelative
if ($changes) { throw 'Commit eerst de themawijzigingen.' }
New-Item -ItemType Directory -Path $releaseRoot -Force | Out-Null
$archive = Join-Path $releaseRoot "frontend-$revision.zip"
& git -C $projectRoot archive --format=zip "--output=$archive" HEAD -- $themeRelative
if ($LASTEXITCODE -ne 0) { throw 'Releasepakket maken mislukt.' }
$hash = (Get-FileHash -LiteralPath $archive -Algorithm SHA256).Hash
"$hash  frontend-$revision.zip" | Set-Content -LiteralPath "$archive.sha256" -Encoding ascii
Write-Output "Release: $archive"
