$b = 'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR4nGNgYAAAAAMAASsJTYQAAAAASUVORK5CYII='
$files = @('04-pull.png','05-run.png','06-localhost.png','07-stop.png','08-rm.png','09-rmi.png')
foreach ($f in $files) {
  [System.Convert]::FromBase64String($b) | Set-Content -Path (Join-Path 'images' $f) -Encoding Byte
}
