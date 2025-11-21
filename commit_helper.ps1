# Git Commit Helper - Alternates between 3 accounts every 2 commits
# Usage: .\commit_helper.ps1 "Your commit message"

param(
    [Parameter(Mandatory=$true)]
    [string]$CommitMessage
)

# Define the accounts
$accounts = @(
    @{name="markpijera"; email="jinwosung490@gmail.com"},
    @{name="cuaton"; email="jademonsalod8@gmail.com"},
    @{name="Jedlang1502"; email="masterbuten66@gmail.com"}
)

# Counter file to track commits
$counterFile = ".commit_counter"

# Initialize counter if file doesn't exist
if (-not (Test-Path $counterFile)) {
    0 | Out-File $counterFile
}

# Read current commit count
$commitCount = [int](Get-Content $counterFile)

# Calculate which account to use (every 2 commits)
$accountIndex = [Math]::Floor($commitCount / 2) % 3
$account = $accounts[$accountIndex]

Write-Host "Using account: $($account.name) <$($account.email)>" -ForegroundColor Cyan
Write-Host "Commit #$($commitCount + 1)" -ForegroundColor Yellow

# Configure git for this commit
git config user.name $account.name
git config user.email $account.email

# Add all changes
git add .

# Commit
git commit -m $CommitMessage

if ($LASTEXITCODE -eq 0) {
    # Increment counter
    $commitCount++
    $commitCount | Out-File $counterFile
    Write-Host "Commit successful!" -ForegroundColor Green
    Write-Host "Next commit will use: $($accounts[[Math]::Floor($commitCount / 2) % 3].name)" -ForegroundColor Magenta
} else {
    Write-Host "Commit failed!" -ForegroundColor Red
}
