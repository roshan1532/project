
<html>
<head>
	<title>MNIT : Internet Access Login</title>
</head>
<body>
	<table width="960px"  align="center" cellspacing="0" >
    	 <tr style="background-image: url(captiveportal-back1.jpg);">
         	<td colspan="2" >  
				<table width="960px" align="center" cellspacing="0" cellpadding="0">
					<tr style="background-image:url(captiveportal-back1.jpg);">
						<td style="border:none" colspan="2" align="center" > 
							<img  src="captiveportal-headermnit.png" alt="" /> 
						</td>
                  </tr>
				</table>
           </td>
		 </tr>
         <tr height="300px">
            <td colspan="2" align="center" style="border: 1px solid #025297;">
				
				<form method="post" action="http://172.16.1.237:8002/index.php?zone=mnit"> 
					<input name="redirurl" type="hidden" value="http://google.com/">
					<input name="zone" type="hidden" value="mnit">
					<center>
						
										<table width="100%" border="0" cellpadding="5" cellspacing="0">
											<tr>
												<td>
													<center>
														<div id="mainarea">
															<center>
																<table width="100%" border="0" cellpadding="5" cellspacing="5">
																	<tr>
																		<td>
																			<div style='color:green;text-align:center;display:none;'>
																				Please use your internet access username and password (LDAP username and password).																				
																			</div>
																			<div id='statusbox' style='color:green;text-align:center;display:block'>
																						<font color='red' face='arial' size='+1'>
																							<b>
																								
																							</b>
																						</font>
																					</div><br/>
																			<div id="maindivarea">
																				<center>
																					<div id='loginbox'>
																						<table style='border:solid 1px black;padding:20px;border-radius:15px;'>									
																							<tr height='50px' ><td colspan='2' align="center" ><h3>MNIT USER LOGIN</h3></td></tr>
																							<tr ><td align="right">Username:</td><td><input autofocus placeholder='ex: mnitjcs000' name="auth_user" type="text" style="border: solid 1px black;padding:2px;"></td></tr>
																							<tr><td align="right">Password:</td><td><input  placeholder='password' name="auth_pass" type="password" style="border: solid 1px black;padding:2px;"></td></tr>
																							<tr><td>&nbsp;</td></tr>
																							<tr><td colspan="2"><center><input name="accept" type="submit" value="LOGIN" style='cursor:pointer;'></center></td></tr>
																						</table>
																					</div>
																				</center>
																			  </div><br/>
																			  <div style='color:gray;text-align:center'>Please allow popup for this webpage from browser to get logout window.</div>
																			</td>
																		</tr>
																	</table>
																</center>
															</div>
														</center>
													</td>
													</tr>
												</table>
									
							</center>
						</form>
					</td></tr>
<tr> <td align="left" style="border: 1px solid #025297;">
<img src="captiveportal-user.png" alt="" width="30px" height="50px"/>
                Only authorized users are permitted to login.
    </td></tr>
     <tr style="background-image: url(captiveportal-back1.jpg);">
         	<td colspan="2" align="center" height="50px">  
                WASTELAND TRACKS, 2007
               </td></tr>
</table>
</body>
</html>
