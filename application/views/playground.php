<h1>Payment iframe:</h1>
<p>Test cards</p>
<ul>
	<li>Card holder: Fill randomly</li>
	<li>Card number: 4159560047417732</li>
	<li>Card expiry date (Month/Year): 08/24</li>
	<li>Card CVV: 123</li>
	<li>3D Secure code: You can get it under the countdown timer on the 3D Secure page</li>
</ul>

<hr>

<!--
<iframe src="<?= $getIframeUrl ?>" width="1010" height="480"></iframe>
-->

<form method="post" action="<?= $getFormUrl ?>">
	<input type="text" name="ThreeDSessionId" value="<?= $ThreeDSessionId?>"><br>
	<input type="text" name="CardHolderName" placeholder="CardHolderName" value="Test Test"><br>
	<input type="text" name="CardNo" placeholder="CardNo" value="4159560047417732"><br>
	<input type="text" name="ExpireDate" placeholder="ExpireDate" value="08/24"><br>
	<input type="text" name="Cvv" placeholder="Cvv" value="123"><br>
	<input type="submit" value="Öde">
</form>
