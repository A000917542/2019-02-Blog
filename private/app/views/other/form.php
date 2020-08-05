<form method="GET">
    <input type="hidden" name="CSRF" value="<?php echo($CSRF) ?>">
    <label>Account: <input type="text" name="account">
    <label>Amount: <input type="number" min="0.0" step="0.01" name="amount">
    <input type="submit">
</form>