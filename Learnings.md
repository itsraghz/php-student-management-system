<h1>Learnings</h1>

## How to send the inputs from a disabled HTML component to server side

Though the UI controls may be disabled based on the role, the value gets
submitted due to the hack applied in the `enablePath()` (user defined)
method in `sms.js` file, where the selected UI controls are enabled just
before the form gets submitted.

Applicable to all such UI controls (checkbox, dropdown etc.,)

> Reference : StackOverflow link : https://stackoverflow.com/a/9413809/1001242
