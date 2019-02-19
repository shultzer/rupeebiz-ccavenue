<html>
<head>
    <title> Non-Seamless-kit</title>
</head>
<body>
<form method="post" name="redirect"
      action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction">
    <input type=hidden name=encRequest value={{$encrypted_data}}>
    <input type=hidden name=access_code value={{$access_code}}>
</form>
<script>document.redirect.submit();</script>
</body>
</html>