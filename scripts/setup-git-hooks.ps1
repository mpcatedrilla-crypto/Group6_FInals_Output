$ErrorActionPreference = "Stop"
$repoRoot = Split-Path -Parent $PSScriptRoot
Set-Location $repoRoot
git config core.hooksPath .githooks
Write-Host "Configured git core.hooksPath to .githooks in $repoRoot"
