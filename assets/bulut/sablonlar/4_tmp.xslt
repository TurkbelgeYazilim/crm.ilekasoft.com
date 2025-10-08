<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="2.0" 
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2"
	xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2"
	xmlns:ccts="urn:un:unece:uncefact:documentation:2"
	xmlns:clm54217="urn:un:unece:uncefact:codelist:specification:54217:2001"
	xmlns:clm5639="urn:un:unece:uncefact:codelist:specification:5639:1988"
	xmlns:clm66411="urn:un:unece:uncefact:codelist:specification:66411:2001"
	xmlns:clmIANAMIMEMediaType="urn:un:unece:uncefact:codelist:specification:IANAMIMEMediaType:2003"
	xmlns:fn="http://www.w3.org/2005/xpath-functions" 
	xmlns:link="http://www.xbrl.org/2003/linkbase"
	xmlns:n1="urn:oasis:names:specification:ubl:schema:xsd:ReceiptAdvice-2"
	xmlns:qdt="urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2"
	xmlns:udt="urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2"
	xmlns:xbrldi="http://xbrl.org/2006/xbrldi" 
	xmlns:xbrli="http://www.xbrl.org/2003/instance"
	xmlns:xdt="http://www.w3.org/2005/xpath-datatypes" 
	xmlns:xlink="http://www.w3.org/1999/xlink"
	xmlns:xs="http://www.w3.org/2001/XMLSchema" 
	xmlns:xsd="http://www.w3.org/2001/XMLSchema"
	xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	exclude-result-prefixes="cac cbc ccts clm54217 clm5639 clm66411 clmIANAMIMEMediaType fn link n1 qdt udt xbrldi xbrli xdt xlink xs xsd xsi">
	<xsl:character-map name="a"> 
		<xsl:output-character character="&#128;" string=""/>
		<xsl:output-character character="&#129;" string=""/>
		<xsl:output-character character="&#130;" string=""/>
		<xsl:output-character character="&#131;" string=""/>
		<xsl:output-character character="&#132;" string=""/>
		<xsl:output-character character="&#133;" string=""/>
		<xsl:output-character character="&#134;" string=""/>
		<xsl:output-character character="&#135;" string=""/>
		<xsl:output-character character="&#136;" string=""/>
		<xsl:output-character character="&#137;" string=""/>
		<xsl:output-character character="&#138;" string=""/>
		<xsl:output-character character="&#139;" string=""/>
		<xsl:output-character character="&#140;" string=""/>
		<xsl:output-character character="&#141;" string=""/>
		<xsl:output-character character="&#142;" string=""/>
		<xsl:output-character character="&#143;" string=""/>
		<xsl:output-character character="&#144;" string=""/>
		<xsl:output-character character="&#145;" string=""/>
		<xsl:output-character character="&#146;" string=""/>
		<xsl:output-character character="&#147;" string=""/>
		<xsl:output-character character="&#148;" string=""/>
		<xsl:output-character character="&#149;" string=""/>
		<xsl:output-character character="&#150;" string=""/>
		<xsl:output-character character="&#151;" string=""/>
		<xsl:output-character character="&#152;" string=""/>
		<xsl:output-character character="&#153;" string=""/>
		<xsl:output-character character="&#154;" string=""/>
		<xsl:output-character character="&#155;" string=""/>
		<xsl:output-character character="&#156;" string=""/>
		<xsl:output-character character="&#157;" string=""/>
		<xsl:output-character character="&#158;" string=""/>
		<xsl:output-character character="&#159;" string=""/>
	</xsl:character-map> 
	<xsl:decimal-format name="european" decimal-separator="," grouping-separator="." NaN=""/>
	<xsl:output version="4.0" method="html" indent="no" encoding="UTF-8"
		doctype-public="-//W3C//DTD HTML 4.01 Transitional//EN"
		doctype-system="http://www.w3.org/TR/html4/loose.dtd" use-character-maps="a"/>
	<xsl:param name="SV_OutputFormat" select="'HTML'"/>
	<xsl:variable name="XML" select="/"/>


	<xsl:template match="/">
		<html>
			<head>
				<style type="text/css">
					body {
					    background-color: #FFFFFF;
					    font-family: 'Tahoma', "Times New Roman", Times, serif;
					    font-size: 11px;
					    color: #666666;
					}
					h1, h2 {
					    padding-bottom: 3px;
					    padding-top: 3px;
					    margin-bottom: 5px;
					    text-transform: uppercase;
					    font-family: Arial, Helvetica, sans-serif;
					}
					h1 {
					    font-size: 1.4em;
					    text-transform:none;
					}
					h2 {
					    font-size: 1em;
					    color: brown;
					}
					h3 {
					    font-size: 1em;
					    color: #333333;
					    text-align: justify;
					    margin: 0;
					    padding: 0;
					}
					h4 {
					    font-size: 1.1em;
					    font-style: bold;
					    font-family: Arial, Helvetica, sans-serif;
					    color: #000000;
					    margin: 0;
					    padding: 0;
					}
					hr {
					    height:2px;
					    color: #000000;
					    background-color: #000000;
					    border-bottom: 1px solid #000000;
					}
					p, ul, ol {
					    margin-top: 1.5em;
					}
					ul, ol {
					    margin-left: 3em;
					}
					blockquote {
					    margin-left: 3em;
					    margin-right: 3em;
					    font-style: italic;
					}
					a {
					    text-decoration: none;
					    color: #70A300;
					}
					a:hover {
					    border: none;
					    color: #70A300;
					}
					#despatchTable {
					    border-collapse:collapse;
					    font-size:11px;
					    float:right;
					    border-color:gray;
					}
					#ettnTable {
					    border-collapse:collapse;
					    font-size:11px;
					    border-color:gray;
					}
					#customerPartyTable {
					    border-width: 0px;
					    border-spacing:;
					    border-style: inset;
					    border-color: gray;
					    border-collapse: collapse;
					    background-color:
					}
					#customerIDTable {
					    border-width: 2px;
					    border-spacing:;
					    border-style: inset;
					    border-color: gray;
					    border-collapse: collapse;
					    background-color:
					}
					#customerIDTableTd {
					    border-width: 2px;
					    border-spacing:;
					    border-style: inset;
					    border-color: gray;
					    border-collapse: collapse;
					    background-color:
					}
					#lineTable {
					    border-width:2px;
					    border-spacing:;
					    border-style: inset;
					    border-color: black;
					    border-collapse: collapse;
					    background-color:;
					}
					td.lineTableTd {
					    border-width: 1px;
					    padding: 1px;
					    border-style: inset;
					    border-color: black;
					    background-color: white;
					}
					tr.lineTableTr {
					    border-width: 1px;
					    padding: 0px;
					    border-style: inset;
					    border-color: black;
					    background-color: white;
					    -moz-border-radius:;
					}
					#lineTableDummyTd {
					    border-width: 1px;
					    border-color:white;
					    padding: 1px;
					    border-style: inset;
					    border-color: black;
					    background-color: white;
					}
					td.lineTableBudgetTd {
					    border-width: 2px;
					    border-spacing:0px;
					    padding: 1px;
					    border-style: inset;
					    border-color: black;
					    background-color: white;
					    -moz-border-radius:;
					}
					#notesTable {
					    border-width: 2px;
					    border-spacing:;
					    border-style: inset;
					    border-color: black;
					    border-collapse: collapse;
					    background-color:
					}
					#notesTableTd {
					    border-width: 0px;
					    border-spacing:;
					    border-style: inset;
					    border-color: black;
					    border-collapse: collapse;
					    background-color: ;
						vertical-align: top;
					}
					table {
					    border-spacing:0px;
					}
					#budgetContainerTable {
					    border-width: 0px;
					    border-spacing: 0px;
					    border-style: inset;
					    border-color: black;
					    border-collapse: collapse;
					    background-color:;
					}
					td {
					    border-color:gray;
					}</style>
				<title>İrsaliye Yanıtı</title>
			</head>
			<body
				style="margin-left=0.6in; margin-right=0.6in; margin-top=0.79in; margin-bottom=0.79in">
				<xsl:for-each select="$XML">
					<table style="border-color:blue; " border="0" cellspacing="0px" width="800"
						cellpadding="0px">
						<tbody>
							<tr valign="top">
								<td width="40%">
									<br/>
									<hr/>
									<table align="center" border="0" width="100%">
										<tbody>
											<tr align="left">
												<xsl:for-each select="n1:ReceiptAdvice/cac:DeliveryCustomerParty/cac:Party">
													<td align="left">
														<xsl:if test="cac:PartyName">
															<xsl:value-of select="cac:PartyName/cbc:Name"/>
															<br/>
														</xsl:if>
														<xsl:for-each select="cac:Person">
																<xsl:for-each select="cbc:Title">
																	<xsl:apply-templates/>
																	<span>
																		<xsl:text>&#160;</xsl:text>
																	</span>
																</xsl:for-each>
																<xsl:for-each select="cbc:FirstName">
																	<xsl:apply-templates/>
																	<span>
																		<xsl:text>&#160;</xsl:text>
																	</span>
																</xsl:for-each>
																<xsl:for-each select="cbc:MiddleName">
																	<xsl:apply-templates/>
																	<span>
																		<xsl:text>&#160;</xsl:text>
																	</span>
																</xsl:for-each>
																<xsl:for-each select="cbc:FamilyName">
																	<xsl:apply-templates/>
																	<span>
																		<xsl:text>&#160;</xsl:text>
																	</span>
																</xsl:for-each>
																<xsl:for-each select="cbc:NameSuffix">
																	<xsl:apply-templates/>
																</xsl:for-each>
															</xsl:for-each>

													</td>
												</xsl:for-each>
											</tr>
											<tr align="left">
												<xsl:for-each select="n1:ReceiptAdvice/cac:DeliveryCustomerParty/cac:Party">
													<td align="left">
														<xsl:for-each select="cac:PostalAddress">
															<xsl:for-each select="cbc:StreetName">
																<xsl:apply-templates/>
																<xsl:text>&#160;</xsl:text>
															</xsl:for-each>
															<xsl:for-each select="cbc:BuildingName">
																<xsl:apply-templates/>
															</xsl:for-each>
															<xsl:if test="cbc:BuildingNumber">
																<xsl:text> No:</xsl:text>
																<xsl:for-each select="cbc:BuildingNumber">
																	<xsl:apply-templates/>
																</xsl:for-each>
																<xsl:text>&#160;</xsl:text>
															</xsl:if>
															<br/>
															<xsl:for-each select="cbc:PostalZone">
																<xsl:apply-templates/>
																<xsl:text>&#160;</xsl:text>
															</xsl:for-each>
															<xsl:for-each select="cbc:CitySubdivisionName">
																<xsl:apply-templates/>
															</xsl:for-each>
															<xsl:text>/ </xsl:text>
															<xsl:for-each select="cbc:CityName">
																<xsl:apply-templates/>
																<xsl:text>&#160;</xsl:text>
															</xsl:for-each>
														</xsl:for-each>
													</td>
												</xsl:for-each>
											</tr>
											<xsl:if
												test="//n1:ReceiptAdvice/cac:DeliveryCustomerParty/cac:Party/cac:Contact/cbc:Telephone or //n1:ReceiptAdvice/cac:DeliveryCustomerParty/cac:Party/cac:Contact/cbc:Telefax">
												<tr align="left">
													<xsl:for-each select="n1:ReceiptAdvice/cac:DeliveryCustomerParty/cac:Party">														
														<td align="left">
															<xsl:for-each select="cac:Contact">
																<xsl:if test="cbc:Telephone">
																	<xsl:text>Tel: </xsl:text>
																	<xsl:for-each select="cbc:Telephone">
																		<xsl:apply-templates/>
																	</xsl:for-each>
																</xsl:if>
																<xsl:if test="cbc:Telefax">
																	<xsl:text> Fax: </xsl:text>
																	<xsl:for-each select="cbc:Telefax">
																		<xsl:apply-templates/>
																	</xsl:for-each>
																</xsl:if>
																<xsl:text>&#160;</xsl:text>
															</xsl:for-each>
														</td>
													</xsl:for-each>
												</tr>
											</xsl:if>
											<xsl:for-each
												select="//n1:ReceiptAdvice/cac:DeliveryCustomerParty/cac:Party/cbc:WebsiteURI">
												<tr align="left">
													<td>
														<xsl:text>Web Sitesi: </xsl:text>
														<xsl:value-of select="."/>
													</td>
												</tr>
											</xsl:for-each>
											<xsl:for-each
												select="//n1:ReceiptAdvice/cac:DeliveryCustomerParty/cac:Party/cac:Contact/cbc:ElectronicMail">
												<tr align="left">
													<td>
														<xsl:text>E-Posta: </xsl:text>
														<xsl:value-of select="."/>
													</td>
												</tr>
											</xsl:for-each>
											<tr align="left">
												<xsl:for-each select="n1:ReceiptAdvice/cac:DeliveryCustomerParty/cac:Party">																											
													<td align="left">
														<xsl:text>Vergi Dairesi: </xsl:text>
														<xsl:for-each select="cac:PartyTaxScheme">
															<xsl:for-each select="cac:TaxScheme">
																<xsl:for-each select="cbc:Name">
																	<xsl:apply-templates/>
																</xsl:for-each>
															</xsl:for-each>
															<xsl:text>&#160; </xsl:text>
														</xsl:for-each>
													</td>
												</xsl:for-each>
											</tr>
											<xsl:for-each
												select="//n1:ReceiptAdvice/cac:DeliveryCustomerParty/cac:Party/cac:PartyIdentification">
												<tr align="left">
													<td>
														<xsl:value-of select="cbc:ID/@schemeID"/>
														<xsl:text>: </xsl:text>
														<xsl:value-of select="cbc:ID"/>
													</td>
												</tr>
											</xsl:for-each>
										</tbody>
									</table>
									<hr/>
								</td>
								<td width="20%" align="center" valign="middle">
									<br/>
									<br/>
									<img style="width:91px;" align="middle" alt="E-Fatura Logo"
										src="data:image/jpeg;base64,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"/>

									<h1 align="center">
										<span style="font-weight:bold; ">
											<xsl:text>İRSALİYE YANITI</xsl:text>
										</span>
									</h1>
								</td>
								<td width="40%"/>
							</tr>
							<tr style="height:118px; " valign="top">
								<td width="40%" align="right" valign="bottom">
									<table id="customerPartyTable" align="left" border="0">
										<tbody>
											<tr style="height:71px; ">
												<td>
													<hr/>
													<table align="center" border="0">
														<tbody>
															<tr>
																<xsl:for-each select="n1:ReceiptAdvice/cac:DespatchSupplierParty/cac:Party">
																	<td style="width:469px; " align="left">
																		<span style="font-weight:bold; ">
																			<xsl:text>SAYIN</xsl:text>
																		</span>
																	</td>
																</xsl:for-each>													
															</tr>
															<tr>
																<xsl:choose>
																	<xsl:when test="n1:ReceiptAdvice/cac:BuyerCustomerParty/cac:Party/cac:PartyIdentification/cbc:ID[@schemeID='PARTYTYPE' and text()='TAXFREE']">
																		<xsl:for-each select="n1:ReceiptAdvice/cac:BuyerCustomerParty/cac:Party">
																			<xsl:call-template name="Party_Title">
																				<xsl:with-param name="PartyType">TAXFREE</xsl:with-param>
																			</xsl:call-template>
																		</xsl:for-each>															
																	</xsl:when>
																	<xsl:otherwise>
																		<xsl:for-each select="n1:ReceiptAdvice/cac:DespatchSupplierParty/cac:Party">
																			<xsl:call-template name="Party_Title">
																				<xsl:with-param name="PartyType">OTHER</xsl:with-param>
																			</xsl:call-template>
																		</xsl:for-each>															
																	</xsl:otherwise>
																</xsl:choose>													
															</tr>
															<xsl:choose>
																<xsl:when test="n1:ReceiptAdvice/cac:BuyerCustomerParty/cac:Party/cac:PartyIdentification/cbc:ID[@schemeID='PARTYTYPE' and text()='TAXFREE']">
																	<xsl:for-each select="n1:ReceiptAdvice/cac:BuyerCustomerParty/cac:Party">
																		<tr>
																			<xsl:call-template name="Party_Adress">
																				<xsl:with-param name="PartyType">TAXFREE</xsl:with-param>
																			</xsl:call-template>
																		</tr>
																		<xsl:call-template name="Party_Other">
																			<xsl:with-param name="PartyType">TAXFREE</xsl:with-param>
																		</xsl:call-template>
																	</xsl:for-each>															
																</xsl:when>
																<xsl:otherwise>
																	<xsl:for-each select="n1:ReceiptAdvice/cac:DespatchSupplierParty/cac:Party">
																		<tr>
																			<xsl:call-template name="Party_Adress">
																				<xsl:with-param name="PartyType">OTHER</xsl:with-param>																	
																			</xsl:call-template>
																		</tr>
																		<xsl:call-template name="Party_Other">
																			<xsl:with-param name="PartyType">OTHER</xsl:with-param>
																		</xsl:call-template>
																	</xsl:for-each>
																</xsl:otherwise>
															</xsl:choose>																										
														</tbody>
													</table>
													<hr/>
												</td>
											</tr>
										</tbody>
									</table>
									<br/>
								</td>
								<td width="60%" align="center" valign="bottom" colspan="2">
									<table border="1" id="despatchTable">
										<tbody>
											<tr>
												<td style="width:135px;" align="left">
													<span style="font-weight:bold; ">
														<xsl:text>Özelleştirme No:</xsl:text>
													</span>
												</td>
												<td style="width:110px;" align="left">
													<xsl:for-each select="n1:ReceiptAdvice/cbc:CustomizationID">
														<xsl:apply-templates/>
													</xsl:for-each>
												</td>
											</tr>
											<tr style="height:13px; ">
												<td align="left">
													<span style="font-weight:bold; ">
														<xsl:text>Senaryo:</xsl:text>
													</span>
												</td>
												<td align="left">
													<xsl:for-each select="n1:ReceiptAdvice/cbc:ProfileID">
														<xsl:apply-templates/>
													</xsl:for-each>
												</td>
											</tr>
											<tr style="height:13px; ">
												<td align="left">
													<span style="font-weight:bold; ">
														<xsl:text>İrsaliye Yanıtı Tipi:</xsl:text>
													</span>
												</td>
												<td align="left">
													<xsl:for-each select="n1:ReceiptAdvice/cbc:ReceiptAdviceTypeCode">
														<xsl:apply-templates/>
													</xsl:for-each>
												</td>
											</tr>
											<tr style="height:13px; ">
												<td align="left">
													<span style="font-weight:bold; ">
														<xsl:text>İrsaliye Yanıtı No:</xsl:text>
													</span>
												</td>
												<td align="left">
													<xsl:for-each select="n1:ReceiptAdvice/cbc:ID">
														<xsl:apply-templates/>
													</xsl:for-each>
												</td>
											</tr>
											<tr style="height:13px; ">
												<td align="left">
													<span style="font-weight:bold; ">
														<xsl:text>İrsaliye Yanıtı Tarihi:</xsl:text>
													</span>
												</td>
												<td align="left">
													<xsl:for-each select="n1:ReceiptAdvice/cbc:IssueDate">
														<xsl:apply-templates select="."/>
													</xsl:for-each>
												</td>
											</tr>
											<tr style="height:13px; ">
												<td align="left">
													<span style="font-weight:bold; ">
														<xsl:text>İrsaliye Yanıtı Zamanı:</xsl:text>
													</span>
												</td>
												<td align="left">
													<xsl:for-each select="n1:ReceiptAdvice/cbc:IssueTime">
														<xsl:apply-templates select="."/>
													</xsl:for-each>
												</td>
											</tr>
											<tr style="height:13px; ">
												<td align="left">
													<span style="font-weight:bold; ">
														<xsl:text>Teslim Tarihi:</xsl:text>
													</span>
												</td>
												<td align="left">
													<xsl:for-each select="n1:ReceiptAdvice/cac:Shipment/cac:Delivery/cbc:ActualDeliveryDate">
														<xsl:apply-templates select="."/>
													</xsl:for-each>
												</td>
											</tr>
											<tr style="height:13px; ">
												<td align="left">
													<span style="font-weight:bold; ">
														<xsl:text>Teslim Zamanı:</xsl:text>
													</span>
												</td>
												<td align="left">
													<xsl:for-each select="n1:ReceiptAdvice/cac:Shipment/cac:Delivery/cbc:ActualDeliveryTime">
														<xsl:apply-templates select="."/>
													</xsl:for-each>
												</td>
											</tr>
											<xsl:if test="n1:ReceiptAdvice/cac:DespatchDocumentReference">
												<tr style="height:13px">
													<td align="left">
														<span style="font-weight:bold; ">
															<xsl:text>İrsaliye No:</xsl:text>
														</span>
													</td>
													<td align="left">
														<xsl:for-each select="n1:ReceiptAdvice/cac:DespatchDocumentReference/cbc:ID">
															<xsl:apply-templates/>
														</xsl:for-each>
													</td>
												</tr>
											</xsl:if>
											<xsl:if	test="n1:ReceiptAdvice/cac:OrderReference/cbc:IssueDate">
												<tr style="height:13px">
													<td align="left">
														<span style="font-weight:bold; ">
															<xsl:text>İrsaliye Tarihi:</xsl:text>
														</span>
													</td>
													<td align="left">
														<xsl:for-each select="n1:ReceiptAdvice/cac:DespatchDocumentReference/cbc:IssueDate">
															<xsl:apply-templates select="."/>
														</xsl:for-each>
													</td>
												</tr>
											</xsl:if>

											<xsl:if test="n1:ReceiptAdvice/cac:OrderReference">
												<tr style="height:13px">
													<td align="left">
														<span style="font-weight:bold; ">
															<xsl:text>Sipariş No:</xsl:text>
														</span>
													</td>
													<td align="left">
														<xsl:for-each select="n1:ReceiptAdvice/cac:OrderReference/cbc:ID">
															<xsl:apply-templates/>
														</xsl:for-each>
													</td>
												</tr>
											</xsl:if>
											<xsl:if	test="n1:ReceiptAdvice/cac:OrderReference/cbc:IssueDate">
												<tr style="height:13px">
													<td align="left">
														<span style="font-weight:bold; ">
															<xsl:text>Sipariş Tarihi:</xsl:text>
														</span>
													</td>
													<td align="left">
														<xsl:for-each select="n1:ReceiptAdvice/cac:OrderReference/cbc:IssueDate">
															<xsl:apply-templates select="."/>
														</xsl:for-each>
													</td>
												</tr>
											</xsl:if>
										</tbody>
									</table>
								</td>
							</tr>
							<tr align="left">
								<td align="left" valign="top" id="ettnTable">
									<span style="font-weight:bold; ">
										<xsl:text>ETTN:&#160;</xsl:text>
									</span>
									<xsl:for-each select="n1:ReceiptAdvice/cbc:UUID">
										<xsl:apply-templates/>
									</xsl:for-each>
								</td>
							</tr>
						</tbody>
					</table>
					<div id="lineTableAligner">
						<span>
							<xsl:text>&#160;</xsl:text>
						</span>
					</div>
					<table border="1" id="lineTable" width="800">
						<tbody>
							<tr class="lineTableTr">
								<td class="lineTableTd" style="width:5%" align="center">
									<span style="font-weight:bold;">
										<xsl:text>Sıra No</xsl:text>
									</span>
								</td>
								<td class="lineTableTd" style="width:25%" align="center">
									<span style="font-weight:bold;">
										<xsl:text>Mal</xsl:text>
									</span>
								</td>
								<td class="lineTableTd" style="width:12%" align="center">
									<span style="font-weight:bold;">
										<xsl:text>Teslim Alınan Miktar</xsl:text>
									</span>
								</td>
								<td class="lineTableTd" style="width:10%" align="center">
									<span style="font-weight:bold;">
										<xsl:text>Kabul Edilmeyen Miktar</xsl:text>
									</span>
								</td>
								<td class="lineTableTd" style="width:8%" align="center">
									<span style="font-weight:bold;">
										<xsl:text>Eksik Miktar</xsl:text>
									</span>
								</td>

								<td class="lineTableTd" style="width:8%" align="center">
									<span style="font-weight:bold;">
										<xsl:text>Fazla Miktar</xsl:text>
									</span>
								</td>
								<td class="lineTableTd" style="width:32%" align="center">
									<span style="font-weight:bold;">
										<xsl:text>Açıklama</xsl:text>
									</span>
								</td>
							</tr>

							<xsl:for-each select="//n1:ReceiptAdvice/cac:ReceiptLine">
								<xsl:apply-templates select="."/>
							</xsl:for-each>

						</tbody>
					</table>
				</xsl:for-each>
				<table id="budgetContainerTable" width="800px">
					<tr align="right">
						<td/>
						<td class="lineTableBudgetTd" align="right" width="156px">
							<span style="font-weight:bold; ">
								<xsl:text>Toplam Tutar</xsl:text>
							</span>
						</td>
						<td class="lineTableBudgetTd" style="width:156px; " align="right">
							<xsl:for-each select="n1:ReceiptAdvice/cac:Shipment/cac:Consignment/cbc:TotalInvoiceAmount">
								<xsl:call-template name="Curr_Type"/>
							</xsl:for-each>
						</td>
					</tr>
				</table>
				<br/>
				<xsl:if test="//n1:ReceiptAdvice/cac:AdditionalDocumentReference">
					<table id="lineTable" width="800">
						<thead>
							<tr>
								<td align="left">
									<span style="font-weight:bold; " align="center">&#160;&#160;&#160;&#160;&#160;İlgili Dokümanlar</span>
								</td>							
								<td align="left">
									<span style="font-weight:bold; " align="center">&#160;&#160;&#160;&#160;&#160;</span>
								</td>
								<td align="left">
									<span style="font-weight:bold; " align="center">&#160;&#160;&#160;&#160;&#160;</span>
								</td>
								<td align="left">
									<span style="font-weight:bold; " align="center">&#160;&#160;&#160;&#160;&#160;</span>
								</td>
							</tr>
						</thead>					
						<tbody>
							<tr align="left" class="lineTableTr">							
								<td class="lineTableTd">
									<span style="font-weight:bold; " align="center">&#160;&#160;&#160;&#160;&#160;Doküman No</span>
								</td>
								<td class="lineTableTd">
									<span style="font-weight:bold; " align="center">&#160;&#160;&#160;&#160;&#160;Tarih</span>
								</td>
								<td class="lineTableTd">
									<span style="font-weight:bold; " align="center">&#160;&#160;&#160;&#160;&#160;Doküman Tipi</span>
								</td>
								<td class="lineTableTd">
									<span style="font-weight:bold; " align="center">&#160;&#160;&#160;&#160;&#160;Açıklama</span>
								</td>
							</tr>
							<xsl:for-each select="//n1:ReceiptAdvice/cac:AdditionalDocumentReference">
								<tr align="left" class="lineTableTr">
									<td class="lineTableTd">&#160;&#160;&#160;&#160;&#160;
										<xsl:value-of select="./cbc:ID"/> 
									</td>
									<td class="lineTableTd">&#160;&#160;&#160;&#160;&#160;
										<xsl:for-each select="./cbc:IssueDate">
											<xsl:apply-templates select="."/>
										</xsl:for-each> 
									</td>
									<td class="lineTableTd">&#160;&#160;&#160;&#160;&#160;
										<xsl:value-of select="./cbc:DocumentType"/> 
									</td>
									<td class="lineTableTd">&#160;&#160;&#160;&#160;&#160;
										<xsl:value-of select="./cbc:DocumentDescription"/> 
									</td>
								</tr>
							</xsl:for-each>
						</tbody>
					</table>
				</xsl:if>
				<br/>
				<table id="notesTable" width="800" align="left">
					<thead>
						<tr>
							<td align="left">
								<span style="font-weight:bold; " align="center">&#160;&#160;&#160;&#160;&#160;Açıklamalar</span>
							</td>
							<td align="left">
								<span style="font-weight:bold; " align="center">&#160;&#160;&#160;&#160;&#160;Taşıyıcı Bilgileri</span>
							</td>								
						</tr>
					</thead>
					<tbody>
						<tr align="left">
							<td id="notesTableTd" height="100">
								<xsl:for-each select="//n1:ReceiptAdvice/cbc:Note">
									<b>&#160;&#160;&#160;&#160;&#160;&#160;Not: </b>
									<xsl:value-of select="."/>	
									<br/>
								</xsl:for-each>	
								<xsl:for-each select="//cac:SellerSupplierParty"> 
									<b>&#160;&#160;&#160;&#160;&#160;&#160;Asıl Satıcı VKN: </b>
									<xsl:value-of select="cac:Party/cac:PartyIdentification/cbc:ID"/>
									<br/>
									<b>&#160;&#160;&#160;&#160;&#160;&#160;Asıl Satıcı Ünvan: </b>
									<xsl:value-of select="cac:Party/cac:PartyName/cbc:Name"/>
									<br/>
								</xsl:for-each>
								<xsl:for-each select="//cac:BuyerCustomerParty"> 
									<b>&#160;&#160;&#160;&#160;&#160;&#160;Asıl Alıcı VKN: </b>
									<xsl:value-of select="cac:Party/cac:PartyIdentification/cbc:ID"/>
									<br/>
									<b>&#160;&#160;&#160;&#160;&#160;&#160;Asıl Alıcı Ünvan: </b>
									<xsl:value-of select="cac:Party/cac:PartyName/cbc:Name"/>
									<br/>
								</xsl:for-each>	
								<xsl:for-each select="//cac:DespatchSupplierParty/cac:DespatchContact/cbc:Name">
									<b>&#160;&#160;&#160;&#160;&#160; Teslim Eden: </b>
									<xsl:apply-templates/>
									<xsl:text>&#160;</xsl:text>
									<br/>
								</xsl:for-each>
								<xsl:for-each select="//cac:DeliveryCustomerParty/cac:DeliveryContact/cbc:Name">
									<b>&#160;&#160;&#160;&#160;&#160; Teslim Alan: </b>
									<xsl:apply-templates/>
									<xsl:text>&#160;</xsl:text>
									<br/>
								</xsl:for-each>
							</td>
							<td id="notesTableTd" height="100">
								<xsl:for-each select="//cac:CarrierParty">
									<b>&#160;&#160;&#160;&#160;&#160;&#160; Taşıyıcı Firma: </b>
									VKN: <xsl:value-of select="./cac:PartyIdentification/cbc:ID"/>, <xsl:value-of select="./cac:PartyName/cbc:Name"/>
									<br/>
								</xsl:for-each>
								<xsl:for-each select="//cac:ShipmentStage/cac:TransportMeans/cac:RoadTransport/cbc:LicensePlateID">
									<b>&#160;&#160;&#160;&#160;&#160;&#160; Araç plaka numarası: </b>
									<xsl:value-of select="."/>	
									<br/>
								</xsl:for-each>	
								<xsl:for-each select="//cac:TransportHandlingUnit/cac:TransportEquipment/cbc:ID[@schemeID = 'DORSEPLAKA']">
									<b>&#160;&#160;&#160;&#160;&#160;&#160; Dorse plaka numarası: </b>
									<xsl:value-of select="."/>	
									<br/>
								</xsl:for-each>	
								<xsl:for-each select="//cac:ShipmentStage/cac:DriverPerson">
									<xsl:if	test="cbc:FirstName">									
										<b>&#160;&#160;&#160;&#160;&#160;&#160; Şoför: </b>
										<xsl:for-each select="cbc:Title">
											<xsl:apply-templates/>
											<xsl:text>&#160;</xsl:text>
										</xsl:for-each>
										<xsl:for-each select="cbc:FirstName">
											<xsl:apply-templates/>
											<xsl:text>&#160;</xsl:text>
										</xsl:for-each>
										<xsl:for-each select="cbc:MiddleName">
											<xsl:apply-templates/>
											<xsl:text>&#160;</xsl:text>
										</xsl:for-each>
										<xsl:for-each select="cbc:FamilyName">
											<xsl:apply-templates/>
											<xsl:text>&#160;</xsl:text>
										</xsl:for-each>, TCKN:
										<xsl:for-each select="cbc:NationalityID">
											<xsl:apply-templates/>
										</xsl:for-each>
										<br/>
									</xsl:if>
								</xsl:for-each>
							</td>
						</tr>
					</tbody>
				</table>

			</body>
		</html>
	</xsl:template>
	<xsl:template match="//n1:ReceiptAdvice/cac:ReceiptLine">
		<tr class="lineTableTr">
			<td class="lineTableTd">
				<xsl:text>&#160;</xsl:text>
				<xsl:value-of select="./cbc:ID"/>
			</td>
			<td class="lineTableTd">
				<xsl:text>&#160;</xsl:text>
				<xsl:value-of select="./cac:Item/cbc:Name"/>
			</td>
			<td class="lineTableTd" align="right">
				<xsl:text>&#160;</xsl:text>
				<xsl:value-of
					select="format-number(./cbc:ReceivedQuantity, '###.###,####', 'european')"/>
				<xsl:if test="./cbc:ReceivedQuantity/@unitCode">
					<xsl:for-each select="./cbc:ReceivedQuantity">
						<xsl:text> </xsl:text>
						<xsl:choose>
							<xsl:when test="@unitCode  = 'TNE'">
								<span>
									<xsl:text>Ton</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'BX'">
								<span>
									<xsl:text>Kutu</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'LTR'">
								<span>
									<xsl:text>LT</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'C62'">
								<span>
									<xsl:text>Adet</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'DAA'">
								<span>
									<xsl:text>Dekar</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KGM'">
								<span>
									<xsl:text>KG</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'HAR'">
								<span>
									<xsl:text>Hektar</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KJO'">
								<span>
									<xsl:text>kJ</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'GRM'">
								<span>
									<xsl:text>G</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MGM'">
								<span>
									<xsl:text>MG</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'NT'">
								<span>
									<xsl:text>Net Ton</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'GT'">
								<span>
									<xsl:text>GT</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MTR'">
								<span>
									<xsl:text>M</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MMT'">
								<span>
									<xsl:text>MM</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KMT'">
								<span>
									<xsl:text>KM</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MLT'">
								<span>
									<xsl:text>ML</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MMQ'">
								<span>
									<xsl:text>MM3</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'CLT'">
								<span>
									<xsl:text>CL</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'CMK'">
								<span>
									<xsl:text>CM2</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'CMQ'">
								<span>
									<xsl:text>CM3</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'CMT'">
								<span>
									<xsl:text>CM</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MTK'">
								<span>
									<xsl:text>M2</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MTQ'">
								<span>
									<xsl:text>M3</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'DAY'">
								<span>
									<xsl:text>Gün</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MON'">
								<span>
									<xsl:text>Ay</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'ANN'">
								<span>
									<xsl:text>Yıl</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'HUR'">
								<span>
									<xsl:text>Saat</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'D61'">
								<span>
									<xsl:text>Dakika</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'D62'">
								<span>
									<xsl:text>Saniye</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'PA'">
								<span>
									<xsl:text>Paket</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'R9'">
								<span>
									<xsl:text>1000 m3</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KWH'">
								<span>
									<xsl:text>KWH</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'GMS'">
								<span>
									<xsl:text>Gümüs</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'CTM'">
								<span>
									<xsl:text>Karat</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'ANN'">
								<span>
									<xsl:text>Yıl</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'HUR'">
								<span>
									<xsl:text>Saat</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MIN'">
								<span>
									<xsl:text>Dakika</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'SEC'">
								<span>
									<xsl:text>Saniye</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'LPA'">
								<span>
									<xsl:text>saf alkol lt</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'BG'">
								<span>
									<xsl:text>Torba</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'PR'">
								<span>
									<xsl:text>Adet-Çift</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'DZN'">
								<span>
									<xsl:text>Düzine</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'SET'">
								<span>
									<xsl:text>Set</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'NPL'">
								<span>
									<xsl:text>Koli</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'FTK'">
								<span>
									<xsl:text>Ayak kare</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'FOT'">
								<span>
									<xsl:text>Ayak</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'AFF'">
								<span>
									<xsl:text>AFİF birim fiyatı</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'AKQ'">
								<span>
									<xsl:text>ATV Birim Fiyatı</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'AYR'">
								<span>
									<xsl:text>Altın ayarı</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'B32'">
								<span>
									<xsl:text>KG-METRE kare</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'BAS'">
								<span>
									<xsl:text>Bas</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'CCT'">
								<span>
									<xsl:text>Ton başı taşıma</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'D30'">
								<span>
									<xsl:text>Brüt Kalori değeri</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'D40'">
								<span>
									<xsl:text>Bin Litre</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'CEN'">
								<span>
									<xsl:text>Yüz adet</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'T3'">
								<span>
									<xsl:text>Bin adet</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'OTB'">
								<span>
									<xsl:text>OTV birim fiyatı</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'OMV'">
								<span>
									<xsl:text>OTV Maktu Vergi</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'D97'">
								<span>
									<xsl:text>Palet</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MLT'">
								<span>
									<xsl:text>Mililitre</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MGM'">
								<span>
									<xsl:text>Miligram</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'GRM'">
								<span>
									<xsl:text>Gram</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KGM'">
								<span>
									<xsl:text>Kilogram</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'GFI'">
								<span>
									<xsl:text>Fıssıle İzotop Gramı</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KUR'">
								<span>
									<xsl:text>Uranyum Kilogramı</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KSH'">
								<span>
									<xsl:text>Sodyum Hidroksit Kilogramı</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KSD'">
								<span>
									<xsl:text>%90 Kuru Ürün Kilogramı</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KPR'">
								<span>
									<xsl:text>Kilogram-Çift</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KPH'">
								<span>
									<xsl:text>Kg Potasyum Oksid</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KFO'">
								<span>
									<xsl:text>Difosfor Pentaoksit Kilogramı</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'K62'">
								<span>
									<xsl:text>Kilogram-Adet</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'K58'">
								<span>
									<xsl:text>Kurutulmuş Net Ağırlıklı Kilogramı</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'K20'">
								<span>
									<xsl:text>Kilogram Potasyum Oksit</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'LO'">
								<span>
									<xsl:text>Lot</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KMA'">
								<span>
									<xsl:text>METİL AMİNLERİN KİLOGRAMI</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KNI'">
								<span>
									<xsl:text>AZOTUN KİLOGRAMI</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'D32'">
								<span>
									<xsl:text>TERAWATT SAAT</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'GWH'">
								<span>
									<xsl:text>GİGAWATT SAAT</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MWH'">
								<span>
									<xsl:text>MEGAWATT SAAT </xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KWT'">
								<span>
									<xsl:text>KİLOWATT </xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'DMK'">
								<span>
									<xsl:text>DESİMETRE KARE</xsl:text>
								</span>
							</xsl:when>
							<xsl:when test="@unitCode  = 'SM3'">
								<span>
									<xsl:text>STANDART METREKÜP</xsl:text>
								</span>
							</xsl:when>						
						</xsl:choose>
					</xsl:for-each>
				</xsl:if>
			</td>
			<td class="lineTableTd" align="right">
				<xsl:text>&#160;</xsl:text>
				<xsl:value-of
					select="format-number(./cbc:RejectedQuantity, '###.###,####', 'european')"/>
				<xsl:if test="./cbc:RejectedQuantity/@unitCode">
					<xsl:for-each select="./cbc:RejectedQuantity">
						<xsl:text> </xsl:text>
						<xsl:choose>
							<xsl:when test="@unitCode  = '26'">
								<xsl:text>ton</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'BX'">
								<xsl:text>Kutu</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'LTR'">
								<xsl:text>lt</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'C62'">
								<xsl:text>Adet</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'NIU'">
								<xsl:text>Adet</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KGM'">
								<xsl:text>kg</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KJO'">
								<xsl:text>kJ</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'GRM'">
								<xsl:text>g</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MGM'">
								<xsl:text>mg</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'NT'">
								<xsl:text>Net Ton</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'GT'">
								<xsl:text>Gross Ton</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MTR'">
								<xsl:text>m</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MMT'">
								<xsl:text>mm</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KTM'">
								<xsl:text>km</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MLT'">
								<xsl:text>ml</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MMQ'">
								<xsl:text>mm3</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'CLT'">
								<xsl:text>cl</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'CMK'">
								<xsl:text>cm2</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'CMQ'">
								<xsl:text>cm3</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'CMT'">
								<xsl:text>cm</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MTK'">
								<xsl:text>m2</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MTQ'">
								<xsl:text>m3</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'DAY'">
								<xsl:text> Gün</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MON'">
								<xsl:text> Ay</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'PA'">
								<xsl:text> Paket</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KWH'">
								<xsl:text> KWH</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'ANN'">
								<xsl:text> Yıl</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'HUR'">
								<xsl:text> Saat</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'D61'">
								<xsl:text> Dakika</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'D62'">
								<xsl:text> Saniye</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'CCT'">
								<xsl:text> Ton baş.taşıma kap.</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'D30'">
								<xsl:text> Brüt kalori</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'D40'">
								<xsl:text> 1000 lt</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'LPA'">
								<xsl:text> saf alkol lt</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'B32'">
								<xsl:text> kg.m2</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'NCL'">
								<xsl:text> hücre adet</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'PR'">
								<xsl:text> Çift</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'R9'">
								<xsl:text> 1000 m3</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'SET'">
								<xsl:text> Set</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'T3'">
								<xsl:text> 1000 adet</xsl:text>
							</xsl:when>							
						</xsl:choose>
					</xsl:for-each>
				</xsl:if>
			</td>
			<td class="lineTableTd" align="right">
				<xsl:text>&#160;</xsl:text>
				<xsl:value-of
					select="format-number(./cbc:ShortQuantity, '###.###,####', 'european')"/>
				<xsl:if test="./cbc:ShortQuantity/@unitCode">
					<xsl:for-each select="./cbc:ShortQuantity">
						<xsl:text> </xsl:text>
						<xsl:choose>
							<xsl:when test="@unitCode  = '26'">
								<xsl:text>ton</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'BX'">
								<xsl:text>Kutu</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'LTR'">
								<xsl:text>lt</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'C62'">
								<xsl:text>Adet</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'NIU'">
								<xsl:text>Adet</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KGM'">
								<xsl:text>kg</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KJO'">
								<xsl:text>kJ</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'GRM'">
								<xsl:text>g</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MGM'">
								<xsl:text>mg</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'NT'">
								<xsl:text>Net Ton</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'GT'">
								<xsl:text>Gross Ton</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MTR'">
								<xsl:text>m</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MMT'">
								<xsl:text>mm</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KTM'">
								<xsl:text>km</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MLT'">
								<xsl:text>ml</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MMQ'">
								<xsl:text>mm3</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'CLT'">
								<xsl:text>cl</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'CMK'">
								<xsl:text>cm2</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'CMQ'">
								<xsl:text>cm3</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'CMT'">
								<xsl:text>cm</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MTK'">
								<xsl:text>m2</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MTQ'">
								<xsl:text>m3</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'DAY'">
								<xsl:text> Gün</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MON'">
								<xsl:text> Ay</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'PA'">
								<xsl:text> Paket</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KWH'">
								<xsl:text> KWH</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'ANN'">
								<xsl:text> Yıl</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'HUR'">
								<xsl:text> Saat</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'D61'">
								<xsl:text> Dakika</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'D62'">
								<xsl:text> Saniye</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'CCT'">
								<xsl:text> Ton baş.taşıma kap.</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'D30'">
								<xsl:text> Brüt kalori</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'D40'">
								<xsl:text> 1000 lt</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'LPA'">
								<xsl:text> saf alkol lt</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'B32'">
								<xsl:text> kg.m2</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'NCL'">
								<xsl:text> hücre adet</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'PR'">
								<xsl:text> Çift</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'R9'">
								<xsl:text> 1000 m3</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'SET'">
								<xsl:text> Set</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'T3'">
								<xsl:text> 1000 adet</xsl:text>
							</xsl:when>							
						</xsl:choose>
					</xsl:for-each>
				</xsl:if>
			</td>
			<td class="lineTableTd" align="right">
				<xsl:text>&#160;</xsl:text>
				<xsl:value-of
					select="format-number(./cbc:OversupplyQuantity, '###.###,####', 'european')"/>
				<xsl:if test="./cbc:OversupplyQuantity/@unitCode">
					<xsl:for-each select="./cbc:OversupplyQuantity">
						<xsl:text> </xsl:text>
						<xsl:choose>
							<xsl:when test="@unitCode  = '26'">
								<xsl:text>ton</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'BX'">
								<xsl:text>Kutu</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'LTR'">
								<xsl:text>lt</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'C62'">
								<xsl:text>Adet</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'NIU'">
								<xsl:text>Adet</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KGM'">
								<xsl:text>kg</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KJO'">
								<xsl:text>kJ</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'GRM'">
								<xsl:text>g</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MGM'">
								<xsl:text>mg</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'NT'">
								<xsl:text>Net Ton</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'GT'">
								<xsl:text>Gross Ton</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MTR'">
								<xsl:text>m</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MMT'">
								<xsl:text>mm</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KTM'">
								<xsl:text>km</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MLT'">
								<xsl:text>ml</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MMQ'">
								<xsl:text>mm3</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'CLT'">
								<xsl:text>cl</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'CMK'">
								<xsl:text>cm2</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'CMQ'">
								<xsl:text>cm3</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'CMT'">
								<xsl:text>cm</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MTK'">
								<xsl:text>m2</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MTQ'">
								<xsl:text>m3</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'DAY'">
								<xsl:text> Gün</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'MON'">
								<xsl:text> Ay</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'PA'">
								<xsl:text> Paket</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'KWH'">
								<xsl:text> KWH</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'ANN'">
								<xsl:text> Yıl</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'HUR'">
								<xsl:text> Saat</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'D61'">
								<xsl:text> Dakika</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'D62'">
								<xsl:text> Saniye</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'CCT'">
								<xsl:text> Ton baş.taşıma kap.</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'D30'">
								<xsl:text> Brüt kalori</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'D40'">
								<xsl:text> 1000 lt</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'LPA'">
								<xsl:text> saf alkol lt</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'B32'">
								<xsl:text> kg.m2</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'NCL'">
								<xsl:text> hücre adet</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'PR'">
								<xsl:text> Çift</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'R9'">
								<xsl:text> 1000 m3</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'SET'">
								<xsl:text> Set</xsl:text>
							</xsl:when>
							<xsl:when test="@unitCode  = 'T3'">
								<xsl:text> 1000 adet</xsl:text>
							</xsl:when>							
						</xsl:choose>
					</xsl:for-each>
				</xsl:if>
			</td>
			<td class="lineTableTd">
				<xsl:text>&#160;</xsl:text>
				<xsl:value-of select="./cbc:Note"/>
				<xsl:text>&#160;</xsl:text>
				<xsl:value-of select="./cbc:RejectReasonCode"/>
			</td>
		</tr>
	</xsl:template>
	<xsl:template match="//cbc:IssueDate">
		<xsl:value-of select="substring(.,9,2)"/>-<xsl:value-of select="substring(.,6,2)"/>-<xsl:value-of select="substring(.,1,4)"/>
	</xsl:template>
	<xsl:template match="//cbc:ActualDespatchDate">
		<xsl:value-of select="substring(.,9,2)"/>-<xsl:value-of select="substring(.,6,2)"/>-<xsl:value-of select="substring(.,1,4)"/>
	</xsl:template>
	<xsl:template match="//cbc:ActualDeliveryDate">
		<xsl:value-of select="substring(.,9,2)"/>-<xsl:value-of select="substring(.,6,2)"/>-<xsl:value-of select="substring(.,1,4)"/>
	</xsl:template>
	<xsl:template match="//n1:ReceiptAdvice">
		<tr class="lineTableTr">
			<td class="lineTableTd">
				<xsl:text>&#160;</xsl:text>
			</td>
			<td class="lineTableTd">
				<xsl:text>&#160;</xsl:text>
			</td>
			<td class="lineTableTd" align="right">
				<xsl:text>&#160;</xsl:text>
			</td>
			<td class="lineTableTd" align="right">
				<xsl:text>&#160;</xsl:text>
			</td>
			<td class="lineTableTd" align="right">
				<xsl:text>&#160;</xsl:text>
			</td>
			<td class="lineTableTd" align="right">
				<xsl:text>&#160;</xsl:text>
			</td>
			<td class="lineTableTd" align="right">
				<xsl:text>&#160;</xsl:text>
			</td>
		</tr>
	</xsl:template>
	<xsl:template name="Party_Title" >
		<xsl:param name="PartyType" />
		<td style="width:469px; " align="left">
			<xsl:if test="cac:PartyName">
				<xsl:value-of select="cac:PartyName/cbc:Name"/>
				<br/>
			</xsl:if>
			<!--xsl:for-each select="cac:Person">
				<xsl:for-each select="cbc:Title">
					<xsl:apply-templates/>
					<xsl:text>&#160;</xsl:text>
				</xsl:for-each>
				<xsl:for-each select="cbc:FirstName">
					<xsl:apply-templates/>
					<xsl:text>&#160;</xsl:text>
				</xsl:for-each>
				<xsl:for-each select="cbc:MiddleName">
					<xsl:apply-templates/>
					<xsl:text>&#160; </xsl:text>
				</xsl:for-each>
				<xsl:for-each select="cbc:FamilyName">
					<xsl:apply-templates/>
					<xsl:text>&#160;</xsl:text>
				</xsl:for-each>
				<xsl:for-each select="cbc:NameSuffix">
					<xsl:apply-templates/>
				</xsl:for-each>
				<xsl:if test="$PartyType='TAXFREE'">
					<br/>
					<xsl:text>Pasaport No: </xsl:text>
					<xsl:value-of select="cac:IdentityDocumentReference/cbc:ID"/>
					<br/>
					<xsl:text>Ülkesi: </xsl:text>
					<xsl:value-of select="cbc:NationalityID"/>	
				</xsl:if>
			</xsl:for-each-->
		</td>		
	</xsl:template>
	<xsl:template name="Party_Adress" >
		<xsl:param name="PartyType" />
		<td style="width:469px; " align="left">
			<xsl:for-each select="cac:PostalAddress">
				<xsl:for-each select="cbc:StreetName">
					<xsl:apply-templates/>
					<xsl:text>&#160;</xsl:text>
				</xsl:for-each>
				<xsl:for-each select="cbc:BuildingName">
					<xsl:apply-templates/>
				</xsl:for-each>
				<xsl:for-each select="cbc:BuildingNumber">
					<xsl:text> No:</xsl:text>
					<xsl:apply-templates/>
					<xsl:text>&#160;</xsl:text>
				</xsl:for-each>
				<br/>
				<xsl:for-each select="cbc:Room">
					<xsl:text>Kapı No:</xsl:text>
					<xsl:apply-templates/>
					<xsl:text>&#160;</xsl:text>
				</xsl:for-each>
				<br/>
				<xsl:for-each select="cbc:PostalZone">
					<xsl:apply-templates/>
					<xsl:text>&#160;</xsl:text>
				</xsl:for-each>
				<xsl:for-each select="cbc:CitySubdivisionName">
					<xsl:apply-templates/>
					<xsl:text>/ </xsl:text>
				</xsl:for-each>
				<xsl:for-each select="cbc:CityName">
					<xsl:apply-templates/>
					<xsl:text>&#160;</xsl:text>
				</xsl:for-each>
				<xsl:if test="$PartyType='TAXFREE'">
					<br/>
					<xsl:value-of select="cac:Country/cbc:Name"/>
					<br/>
				</xsl:if>
			</xsl:for-each>
		</td>
	</xsl:template>
	<xsl:template name='Party_Other'>
		<xsl:param name="PartyType" />
		<xsl:for-each select="cbc:WebsiteURI">
			<tr align="left">
				<td>
					<xsl:text>Web Sitesi: </xsl:text>
					<xsl:value-of select="."/>
				</td>
			</tr>
		</xsl:for-each>
		<xsl:for-each select="cac:Contact/cbc:ElectronicMail">
			<tr align="left">
				<td>
					<xsl:text>E-Posta: </xsl:text>
					<xsl:value-of select="."/>
				</td>
			</tr>
		</xsl:for-each>	
		<xsl:for-each select="cac:Contact">
			<xsl:if test="cbc:Telephone or cbc:Telefax">
				<tr align="left">
					<td style="width:469px; " align="left">
						<xsl:for-each select="cbc:Telephone">
							<xsl:text>Tel: </xsl:text>
							<xsl:apply-templates/>
						</xsl:for-each>
						<xsl:for-each select="cbc:Telefax">
							<xsl:text> Fax: </xsl:text>
							<xsl:apply-templates/>
						</xsl:for-each>
						<xsl:text>&#160;</xsl:text>
					</td>
				</tr>
			</xsl:if>
		</xsl:for-each>
		<xsl:if test="$PartyType!='TAXFREE'">
			<xsl:for-each select="cac:PartyTaxScheme/cac:TaxScheme/cbc:Name">
				<tr align="left">
					<td>
						<xsl:text>Vergi Dairesi: </xsl:text>
						<xsl:apply-templates/>
					</td>
				</tr>
			</xsl:for-each>
			<xsl:for-each select="cac:PartyIdentification">
				<tr align="left">
					<td>
						<xsl:value-of select="cbc:ID/@schemeID"/>
						<xsl:text>: </xsl:text>
						<xsl:value-of select="cbc:ID"/>
					</td>
				</tr>
			</xsl:for-each>
		</xsl:if>
	</xsl:template>
	<xsl:template name="Curr_Type">
		<xsl:value-of select="format-number(., '###.##0,00', 'european')"/>		
		<xsl:if	test="@currencyID">
			<xsl:text> </xsl:text>
			<xsl:choose>
				<xsl:when test="@currencyID = 'TRL' or @currencyID = 'TRY'">
					<xsl:text>TL</xsl:text>					
				</xsl:when>
				<xsl:otherwise>
					<xsl:value-of select="@currencyID"/>
				</xsl:otherwise>
			</xsl:choose>
		</xsl:if>		
	</xsl:template>
</xsl:stylesheet>
