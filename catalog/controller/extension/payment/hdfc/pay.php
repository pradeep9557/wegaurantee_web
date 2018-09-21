<HTML>
<HEAD>
<TITLE>PHP Integration Kit - Request page</TITLE>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<style>
	h1       { font-family:Arial,sans-serif; font-size:24pt; color:#08185A; font-weight:100; margin-bottom:0.1em}
    h2.co    { font-family:Arial,sans-serif; font-size:24pt; color:#FFFFFF; margin-top:0.1em; margin-bottom:0.1em; font-weight:100}
    h3.co    { font-family:Arial,sans-serif; font-size:16pt; color:#000000; margin-top:0.1em; margin-bottom:0.1em; font-weight:100}
    h3       { font-family:Arial,sans-serif; font-size:16pt; color:#08185A; margin-top:0.1em; margin-bottom:0.1em; font-weight:100}
    body     { font-family:Verdana,Arial,sans-serif; font-size:11px; color:#08185A;}
	th 		 { font-size:12px;background:#015289;color:#FFFFFF;font-weight:bold;height:30px;}
	td 		 { font-size:12px;background:#DDE8F3}
	.pageTitle { font-size:24px;}
</style>
</HEAD>
<BODY LEFTMARGIN=0 TOPMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0 bgcolor="#ECF1F7">
<center>
<table width='100%' cellpadding='0' cellspacing="0" ><tr><th width='90%'>&nbsp;</th></tr></table>
	<center><h3>PHP Integration Kit - Request Page</H3></center>

	<form  method="post" action="post.php" name="frmTransaction" id="frmTransaction" >  	 
     <table width="600" cellpadding="2" cellspacing="2" border="0">
        <tr>
            <th colspan="2">Transaction Details</th>
        </tr>
		<tr>
            <td class="fieldName"><span class="error">*</span> Channel</td>
            <td align="left"><select name="channel" >
				<option value="10">Standard</option>
			</select></td>
        </tr>

	   <tr>
            <td class="fieldName" width="50%"><span class="error">*</span> Account Id</td>
            <td  align="left" width="50%"> <input name="account_id" type="text" value=""/><br><span><font color="red"> Please Enter your Account ID provided.</font></span> </td> 
        </tr>
        <tr>
            <td class="fieldName" width="50%"><span class="error">*</span> Secret Key</td>
            <td  align="left" width="50%"> <input name="secretkey" type="text" value="" size="35"/><br><span><font color="red"> Please Enter your Secret Key provided.</font></span></td>
        </tr>
	   <tr>
            <td class="fieldName" width="50%"><span class="error">*</span> Reference No</td>

            <td  align="left" width="50%"> <input name="reference_no" type="text" value="<?php echo time();?>" /></td>
        </tr>
        <tr>
            <td class="fieldName" width="50%"><span class="error">*</span> Sale Amount</td>
            <td  align="left" width="50%"> <input name="amount" type="text" value="<?php echo  rand(100,999);?>" /> <select name="currency" >
				<option value="INR">INR</option>

			</select></td>
        </tr>
		<tr>
		  <td class="fieldName"><span class="error">*</span> Description</td>
		  <td align="left"><input name="description" type="text" value="Test Product" /></td>
	   </tr>
		<tr>
		  <td class="fieldName"><span class="error">*</span> Return Url</td>
		  <td align="left"><input name="return_url" type="text" size="60" value="http://127.0.0.1/hdfcpg/response.php" /></td>
	   </tr>
		<tr>
		  <td class="fieldName"><span class="error">*</span> Mode</td>
		  <td align="left"><select name="mode" >
            <option value="LIVE" selected>LIVE</option>
          </select></td>
	   </tr>
        <tr>
            <th colspan="2">Billing Address</th>
        </tr>

	    <tr>
            <td class="fieldName"><span class="error">*</span> Name</td>
            <td align="left">
                <input name="name" type="text" value="Test Name" /></td>
        </tr>
       
        <tr>

            <td class="fieldName"><span class="error">*</span>Address</td>
            <td align="left">
                <textarea name="address">Test Address</textarea>            </td>
        </tr>

        <tr>
            <td class="fieldName"><span class="error">*</span>City</td>

            <td align="left">
                <input name="city" type="text" value="Mumbai" />            </td>
        </tr>

        <tr>
            <td class="fieldName">State/Province</td>
            <td align="left">
               <input name="state" type="text" value="MH" />            </td>
        </tr>

        <tr>
            <td class="fieldName"><span class="error">*</span>ZIP/Postal Code</td>
            <td align="left">
                <input name="postal_code" type="text" value="400069" />            </td>
        </tr>

        <tr>
            <td class="fieldName"><span class="error">*</span>Country</td>
            <td align="left">
                                <input name="country" type="text" value="IND" />            </td>
        </tr>

        <tr>
            <td class="fieldName"><span class="error">*</span>Email</td>
            <td align="left">
                <input name="email" type="text" value="test@test.com" />            </td>
        </tr>

        <tr>

            <td class="fieldName"><span class="error">*</span>Telephone</td>
            <td align="left"><input name="phone" type="text" value="2211112222" /></td>
        </tr>
		
        <tr>
            <th colspan="2">Delivery Address</th>
        </tr>

		<tr>

            <td class="fieldName"> Name</td>
            <td align="left">
                <input name="ship_name" type="text" value="Test Name" /></td>
        </tr>
       
        <tr>
            <td class="fieldName">Address</td>
            <td align="left">

                <input name="ship_address" type="text" value="Test Address" />            </td>
        </tr>

        <tr>
            <td class="fieldName">City</td>
            <td align="left">
                <input name="ship_city" type="text" value="Mumbai" />            </td>
        </tr>

        <tr>
            <td class="fieldName">State/Province</td>
            <td align="left">
               <input name="ship_state" type="text" value="MH" />            </td>
        </tr>

        <tr>
            <td class="fieldName">ZIP/Postal Code</td>
            <td align="left">
                <input name="ship_postal_code" type="text" value="400069" />            </td>
        </tr>

        <tr>
            <td class="fieldName">Country</td>

            <td align="left"><input name="ship_country" type="text" value="IND" /></td>
        </tr>

        
        <tr>
            <td class="fieldName">Telephone</td>
            <td align="left"><input name="ship_phone" type="text" value="2211112222" /></td>
        </tr>

        <tr>

            <td valign="top" align="center" colspan="2">
                <input name="submitted" value="Submit" type="submit" />&nbsp; 
                 
                    <input value="Reset" type="reset" />                            </td>
        </tr>
	
        <tr>
            <td valign="top" align="center" colspan="2">
                <span class="error">*</span> 
                <span>denotes required field</span>            </td>
        </tr>
    </table>
</form>

</body>
</html>
