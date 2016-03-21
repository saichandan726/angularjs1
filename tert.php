<html>
<body>
<input id="account" value="123456789" />
 
<input id="account_changed" />
 <script>
var account = document.getElementById('account');
var changed = document.getElementById('account_changed');
 
changed.value = new Array(account.value.length-3).join('*') + account.value.substr(account.value.length-4, 4);
</script>
</body>
</html>