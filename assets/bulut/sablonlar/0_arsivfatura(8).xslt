<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="2.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:ccts="urn:un:unece:uncefact:documentation:2" xmlns:clm54217="urn:un:unece:uncefact:codelist:specification:54217:2001" xmlns:clm5639="urn:un:unece:uncefact:codelist:specification:5639:1988" xmlns:clm66411="urn:un:unece:uncefact:codelist:specification:66411:2001" xmlns:clmIANAMIMEMediaType="urn:un:unece:uncefact:codelist:specification:IANAMIMEMediaType:2003" xmlns:fn="http://www.w3.org/2005/xpath-functions" xmlns:link="http://www.xbrl.org/2003/linkbase" xmlns:n1="urn:oasis:names:specification:ubl:schema:xsd:Invoice-2" xmlns:qdt="urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2" xmlns:udt="urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2" xmlns:xbrldi="http://xbrl.org/2006/xbrldi" xmlns:xbrli="http://www.xbrl.org/2003/instance" xmlns:xdt="http://www.w3.org/2005/xpath-datatypes" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:lcl="http://www.efatura.gov.tr/local" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" exclude-result-prefixes="cac cbc ccts clm54217 clm5639 clm66411 clmIANAMIMEMediaType fn link n1 qdt udt xbrldi xbrli xdt xlink xs xsd xsi lcl">
	<xsl:character-map name="a">
		<xsl:output-character character="&#38;" string="&amp;"/>
		<xsl:output-character character="&#34;" string="&quot;"/>
		<xsl:output-character character="&#60;" string="&lt;"/>
		<xsl:output-character character="&#62;" string="&gt;"/>
		<xsl:output-character character="&#39;" string="&apos;"/>
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
	<xsl:output version="4.0" method="html" indent="yes" encoding="UTF-8" doctype-public="-//W3C//DTD HTML 4.01 Transitional//EN" doctype-system="http://www.w3.org/TR/html4/loose.dtd" use-character-maps="a"/>
	<xsl:param name="SV_OutputFormat" select="'HTML'"/>
	<xsl:variable name="XML" select="/"/>
	<xsl:variable name="iskontoCount" select="count(n1:Invoice/cac:InvoiceLine/cac:AllowanceCharge)"/>
	<xsl:variable name="irsaliyeCount" select="count(n1:Invoice/cac:DespatchDocumentReference)"/>
	<xsl:variable name="iadeCount" select="count(n1:Invoice/cac:BillingReference)"/>
	<xsl:variable name="earchiveCheckCount" select="count(n1:Invoice/cac:AdditionalDocumentReference[cbc:DocumentTypeCode = 'SendingType'])"/>
	<xsl:template match="/">
		<html>
			<head>
				<title/>
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
					border-color:black;
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
					#lineTableTd {
					border-width: 1px;
					padding: 1px;
					border-style: inset;
					border-color: black;
					background-color: white;
					}
					#lineTableTr {
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
					#lineTableBudgetTd {
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
					background-color:
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
					#budgetContainerTable2 {
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
				<title>E-Arşiv Fatura</title>
			</head>
			<body style="margin-left=0.6in; margin-right=0.6in; margin-top=0.79in; margin-bottom=0.79in">
				<xsl:for-each select="$XML">
					<table border="0" cellspacing="0px" width="800" cellpadding="0px">
						<tr width="900" height="180" border="0">
							<td>
								<table align="center" border="0" width="100%">
									<tbody>
										<hr/>
										<tr align="left">
											<xsl:for-each select="n1:Invoice">
												<xsl:for-each select="cac:AccountingSupplierParty">
													<xsl:for-each select="cac:Party">
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
												</xsl:for-each>
											</xsl:for-each>
										</tr>
										<tr align="left">
											<xsl:for-each select="n1:Invoice">
												<xsl:for-each select="cac:AccountingSupplierParty">
													<xsl:for-each select="cac:Party">
														<td align="left">
															<xsl:for-each select="cac:PostalAddress">
																<xsl:for-each select="cbc:StreetName">
																	<xsl:if test="//n1:Invoice/cac:AccountingSupplierParty/cac:Party/cac:PostalAddress/cbc:StreetName!=''">
																		<xsl:apply-templates/>
																		<span>
																			<xsl:text>&#160;</xsl:text>
																		</span>
																	</xsl:if>
																</xsl:for-each>
																<xsl:for-each select="cbc:BuildingName">
																	<xsl:apply-templates/>
																</xsl:for-each>
																<xsl:if test="//n1:Invoice/cac:AccountingSupplierParty/cac:Party/cac:PostalAddress/cbc:BuildingNumber!=''">
																	<span>
																		<xsl:text>No:</xsl:text>
																	</span>
																	<xsl:for-each select="cbc:BuildingNumber">
																		<xsl:apply-templates/>
																	</xsl:for-each>
																	<span>
																		<xsl:text>&#160;</xsl:text>
																	</span>
																</xsl:if>
																<br/>
																<xsl:for-each select="cbc:PostalZone">
																	<xsl:apply-templates/>
																	<span>
																		<xsl:text>&#160;</xsl:text>
																	</span>
																</xsl:for-each>
																<xsl:for-each select="cbc:CitySubdivisionName">
																	<xsl:if test="//n1:Invoice/cac:AccountingSupplierParty/cac:Party/cac:PostalAddress/cbc:CitySubdivisionName!=''">
																		<xsl:apply-templates/>
																	</xsl:if>
																</xsl:for-each>
																<span>
																	<xsl:text>/ </xsl:text>
																</span>
																<xsl:for-each select="cbc:CityName">
																	<xsl:if test="//n1:Invoice/cac:AccountingSupplierParty/cac:Party/cac:PostalAddress/cbc:CityName!=''">
																		<xsl:apply-templates/>
																		<span>
																			<xsl:text>&#160;</xsl:text>
																		</span>
																	</xsl:if>
																</xsl:for-each>
															</xsl:for-each>
														</td>
													</xsl:for-each>
												</xsl:for-each>
											</xsl:for-each>
										</tr>
										<xsl:if test="//n1:Invoice/cac:AccountingSupplierParty/cac:Party/cac:Contact/cbc:Telephone or //n1:Invoice/cac:AccountingSupplierParty/cac:Party/cac:Contact/cbc:Telefax">
											<tr align="left">
												<xsl:for-each select="n1:Invoice">
													<xsl:for-each select="cac:AccountingSupplierParty">
														<xsl:for-each select="cac:Party">
															<td align="left">
																<xsl:for-each select="cac:Contact">
																	<xsl:if test="//n1:Invoice/cac:AccountingSupplierParty/cac:Party/cac:Contact/cbc:Telephone!=''">
																		<span>
																			<xsl:text>Tel: </xsl:text>
																		</span>
																		<xsl:for-each select="cbc:Telephone">
																			<xsl:apply-templates/>
																		</xsl:for-each>
																	</xsl:if>
																	<xsl:if test="//n1:Invoice/cac:AccountingSupplierParty/cac:Party/cac:Contact/cbc:Telefax!=''">
																		<span>
																			<xsl:text> Fax: </xsl:text>
																		</span>
																		<xsl:for-each select="cbc:Telefax">
																			<xsl:apply-templates/>
																		</xsl:for-each>
																	</xsl:if>
																	<span>
																		<xsl:text>&#160;</xsl:text>
																	</span>
																</xsl:for-each>
															</td>
														</xsl:for-each>
													</xsl:for-each>
												</xsl:for-each>
											</tr>
										</xsl:if>
										<xsl:for-each select="//n1:Invoice/cac:AccountingSupplierParty/cac:Party/cbc:WebsiteURI">
											<xsl:if test="//n1:Invoice/cac:AccountingSupplierParty/cac:Party/cbc:WebsiteURI!=''">
												<tr align="left">
													<td>
														<xsl:text>Web Sitesi: </xsl:text>
														<xsl:value-of select="."/>
													</td>
												</tr>
											</xsl:if>
										</xsl:for-each>
										<xsl:for-each select="//n1:Invoice/cac:AccountingSupplierParty/cac:Party/cac:Contact/cbc:ElectronicMail">
											<xsl:if test="//n1:Invoice/cac:AccountingSupplierParty/cac:Party/cac:Contact/cbc:ElectronicMail!=''">
												<tr align="left">
													<td>
														<xsl:text>E-Posta: </xsl:text>
														<xsl:value-of select="."/>
													</td>
												</tr>
											</xsl:if>
										</xsl:for-each>
										<tr align="left">
											<xsl:for-each select="n1:Invoice">
												<xsl:for-each select="cac:AccountingSupplierParty">
													<xsl:for-each select="cac:Party">
														<td align="left">
															<span>
																<xsl:text>Vergi Dairesi: </xsl:text>
															</span>
															<xsl:for-each select="cac:PartyTaxScheme">
																<xsl:for-each select="cac:TaxScheme">
																	<xsl:for-each select="cbc:Name">
																		<xsl:apply-templates/>
																	</xsl:for-each>
																</xsl:for-each>
																<span>
																	<xsl:text>&#160; </xsl:text>
																</span>
															</xsl:for-each>
														</td>
													</xsl:for-each>
												</xsl:for-each>
											</xsl:for-each>
										</tr>
										<xsl:for-each select="//n1:Invoice/cac:AccountingSupplierParty/cac:Party/cac:PartyIdentification">
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
							<td width="25%" align="center" valign="middle">
								<img style="width:91px;" align="middle" alt="Gib Logo" src="data:image/jpeg;base64,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"/>
								<h1 align="center">
									<span style="font-weight:bold; ">
										<xsl:text>E-Arşiv Fatura</xsl:text>
									</span>
								</h1>
								<br/>
								<div class="imgBox" valign="middle">
									<img style="width:140px;height:110px;" align="middle" alt="Imza Logo" src="data:image/jpeg;base64,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"/><br/>
								</div>
							</td>
							<td width="300" align="center" valign="middle">
								<img style="width:220px;" align="right" alt="Company Logo" src="data:image/jpeg;base64,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"/><br/>
							</td>
						</tr>
						<tr width="900" height="180" border="1">
							<td width="300">
								<table id="customerPartyTable" align="left" border="0" height="50%">
									<tbody>
										<tr style="height:71px; ">
											<td>
												<hr/>
												<table align="center" border="0">
													<tbody>
														<tr>
															<xsl:for-each select="n1:Invoice/cac:AccountingCustomerParty/cac:Party">
																<td style="width:469px; " align="left">
																	<span style="font-weight:bold; ">
																		<xsl:text>SAYIN</xsl:text>
																	</span>
																</td>
															</xsl:for-each>
														</tr>
														<tr>
															<xsl:choose>
																<xsl:when test="n1:Invoice/cac:BuyerCustomerParty/cac:Party/cac:PartyIdentification/cbc:ID[@schemeID='PARTYTYPE' and text()='TAXFREE']">
																	<xsl:for-each select="n1:Invoice/cac:BuyerCustomerParty/cac:Party">
																		<xsl:call-template name="Party_Title">
																			<xsl:with-param name="PartyType">TAXFREE</xsl:with-param>
																		</xsl:call-template>
																	</xsl:for-each>
																</xsl:when>
																<xsl:when test="n1:Invoice/cac:BuyerCustomerParty/cac:Party/cac:PartyIdentification/cbc:ID[@schemeID='PARTYTYPE' and text()='EXPORT']">
																	<xsl:for-each select="n1:Invoice/cac:BuyerCustomerParty/cac:Party">
																		<xsl:call-template name="Party_Title">
																			<xsl:with-param name="PartyType">EXPORT</xsl:with-param>
																		</xsl:call-template>
																	</xsl:for-each>
																</xsl:when>
																<xsl:otherwise>
																	<xsl:for-each select="n1:Invoice/cac:AccountingCustomerParty/cac:Party">
																		<xsl:call-template name="Party_Title">
																			<xsl:with-param name="PartyType">OTHER</xsl:with-param>
																		</xsl:call-template>
																	</xsl:for-each>
																</xsl:otherwise>
															</xsl:choose>
														</tr>
														<xsl:choose>
															<xsl:when test="n1:Invoice/cac:BuyerCustomerParty/cac:Party/cac:PartyIdentification/cbc:ID[@schemeID='PARTYTYPE' and text()='TAXFREE']">
																<xsl:for-each select="n1:Invoice/cac:BuyerCustomerParty/cac:Party">
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
															<xsl:when test="n1:Invoice/cac:BuyerCustomerParty/cac:Party/cac:PartyIdentification/cbc:ID[@schemeID='PARTYTYPE' and text()='EXPORT']">
																<xsl:for-each select="n1:Invoice/cac:BuyerCustomerParty/cac:Party">
																	<tr>
																		<xsl:call-template name="Party_Adress">
																			<xsl:with-param name="PartyType">EXPORT</xsl:with-param>
																		</xsl:call-template>
																	</tr>
																	<xsl:call-template name="Party_Other">
																		<xsl:with-param name="PartyType">EXPORT</xsl:with-param>
																	</xsl:call-template>
																</xsl:for-each>
															</xsl:when>
															<xsl:otherwise>
																<xsl:for-each select="n1:Invoice/cac:AccountingCustomerParty/cac:Party">
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
							</td>
							<td width="25%" align="center" valign="middle">
							</td>
							<td width="300">
								<table border="1" height="13" id="despatchTable">
									<tbody>
										<tr>
											<td style="width:105px;" align="left">
												<span style="font-weight:bold; ">
													<xsl:text>Özelleştirme No:</xsl:text>
												</span>
											</td>
											<td style="width:110px;" align="left">
												<xsl:for-each select="n1:Invoice">
													<xsl:for-each select="cbc:CustomizationID">
														<xsl:apply-templates/>
													</xsl:for-each>
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
												<xsl:for-each select="n1:Invoice">
													<xsl:for-each select="cbc:ProfileID">
														<xsl:apply-templates/>
													</xsl:for-each>
												</xsl:for-each>
											</td>
										</tr>
										<tr style="height:13px; ">
											<td align="left">
												<span style="font-weight:bold; ">
													<xsl:text>Fatura Tipi:</xsl:text>
												</span>
											</td>
											<td align="left">
												<xsl:for-each select="n1:Invoice">
													<xsl:for-each select="cbc:InvoiceTypeCode">
														<xsl:apply-templates/>
													</xsl:for-each>
												</xsl:for-each>
											</td>
										</tr>
										<tr style="height:13px; ">
											<td align="left">
												<span style="font-weight:bold; ">
													<xsl:text>Fatura No:</xsl:text>
												</span>
											</td>
											<td align="left">
												<xsl:for-each select="n1:Invoice">
													<xsl:for-each select="cbc:ID">
														<xsl:apply-templates/>
													</xsl:for-each>
												</xsl:for-each>
											</td>
										</tr>
										<tr style="height:13px; ">
											<td align="left">
												<span style="font-weight:bold; ">
													<xsl:if test="$earchiveCheckCount &gt; 0">
														Düzenleme Tarihi:
													</xsl:if>
													<xsl:if test="$earchiveCheckCount = 0">
														Fatura Tarihi:
													</xsl:if>
												</span>
											</td>
											<td align="left">
												<xsl:for-each select="n1:Invoice">
													<xsl:for-each select="cbc:IssueDate">
														<xsl:value-of select="substring(.,9,2)"/>-<xsl:value-of select="substring(.,6,2)"/>-<xsl:value-of select="substring(.,1,4)"/>
													</xsl:for-each>
												</xsl:for-each>
											</td>
										</tr>
										<xsl:if test="//n1:Invoice/cac:AdditionalDocumentReference/cbc:DocumentType = 'KAGIT' and  //n1:Invoice/cac:AdditionalDocumentReference/cbc:DocumentTypeCode = 'SendingType'
										or count(//n1:Invoice/cac:DespatchDocumentReference)=0">
											<tr style="height:13px; ">
												<td align="left">
													<span style="font-weight:bold; ">
														<xsl:text>Düzenleme Zamanı:</xsl:text>
													</span>
												</td>
												<td align="left">
													<xsl:for-each select="n1:Invoice">
														<xsl:for-each select="cbc:IssueTime">
															<xsl:value-of select="substring(.,1,2)"/>:<xsl:value-of select="substring(.,4,2)"/>:<xsl:value-of select="substring(.,7,2)"/>
														</xsl:for-each>
													</xsl:for-each>
												</td>
											</tr>
										</xsl:if>
										<xsl:if test="//n1:Invoice/cac:AdditionalDocumentReference/cbc:DocumentType = 'ELEKTRONIK' and  //n1:Invoice/cac:AdditionalDocumentReference/cbc:DocumentTypeCode = 'SendingType'">
											<tr style="height:13px; ">
												<td align="left">
													<span style="font-weight:bold; ">
														<xsl:text>Düzenleme Zamanı:</xsl:text>
													</span>
												</td>
												<td align="left">
													<xsl:for-each select="n1:Invoice">
														<xsl:for-each select="cbc:IssueTime">
															<xsl:value-of select="substring(.,1,2)"/>:<xsl:value-of select="substring(.,4,2)"/>:<xsl:value-of select="substring(.,7,2)"/>
														</xsl:for-each>
													</xsl:for-each>
												</td>
											</tr>
										</xsl:if>
										<xsl:for-each select="n1:Invoice/cac:DespatchDocumentReference[position() &lt;2]">
											<tr style="height:13px; ">
												<td align="left">
													<span style="font-weight:bold; ">
														<xsl:text>İrsaliye No-Tarih:</xsl:text>
													</span>
													<span>
														<xsl:text>&#160;</xsl:text>
														<xsl:if test="$irsaliyeCount &gt; 1">
															<xsl:text>(</xsl:text>
															<xsl:value-of select="$irsaliyeCount"/>
															<xsl:text>) </xsl:text>
														</xsl:if>
													</span>
												</td>
												<td align="left">
													<xsl:value-of select="cbc:ID"/>-
													<xsl:for-each select="cbc:IssueDate">
														<xsl:value-of select="substring(.,9,2)"/>.<xsl:value-of select="substring(.,6,2)"/>.<xsl:value-of select="substring(.,1,4)"/>
													</xsl:for-each>
												</td>
											</tr>
										</xsl:for-each>
										<!--	<xsl:for-each select="n1:Invoice/cac:BillingReference[position() &lt;2]">
											<tr style="height:13px">
												<td align="left">
													<span style="font-weight:bold; ">
														<xsl:text>İade Fatura No - Tarih:</xsl:text>
													</span>
													<span>
														<xsl:text>&#160;</xsl:text>
														<xsl:if test="$iadeCount &gt; 1">
															<xsl:text>(</xsl:text>
															<xsl:value-of select="$iadeCount" />
															<xsl:text>) </xsl:text>
														</xsl:if>
													</span>
												</td>
												<td align="left">
													<xsl:value-of select="cac:InvoiceDocumentReference/cbc:ID" />-
													<xsl:for-each select="cac:InvoiceDocumentReference/cbc:IssueDate">
														<xsl:value-of select="substring(.,9,2)" />.<xsl:value-of select="substring(.,6,2)" />.<xsl:value-of select="substring(.,1,4)" />
													</xsl:for-each>
												</td>
											</tr>
										</xsl:for-each>-->
										<xsl:if test="//n1:Invoice/cac:OrderReference">
											<tr style="height:13px">
												<td align="left">
													<span style="font-weight:bold; ">
														<xsl:text>Sipariş No:</xsl:text>
													</span>
												</td>
												<td align="left">
													<xsl:for-each select="n1:Invoice/cac:OrderReference">
														<xsl:for-each select="cbc:ID">
															<xsl:apply-templates/>
														</xsl:for-each>
													</xsl:for-each>
												</td>
											</tr>
										</xsl:if>
										<xsl:if test="//n1:Invoice/cac:OrderReference/cbc:IssueDate">
											<tr style="height:13px">
												<td align="left">
													<span style="font-weight:bold; ">
														<xsl:text>Sipariş Tarihi:</xsl:text>
													</span>
												</td>
												<td align="left">
													<xsl:for-each select="n1:Invoice/cac:OrderReference">
														<xsl:for-each select="cbc:IssueDate">
															<xsl:value-of select="substring(.,9,2)"/>-<xsl:value-of select="substring(.,6,2)"/>-<xsl:value-of select="substring(.,1,4)"/>
														</xsl:for-each>
													</xsl:for-each>
												</td>
											</tr>
										</xsl:if>
										<xsl:for-each select="n1:Invoice/cac:TaxRepresentativeParty/cac:PartyIdentification/cbc:ID[@schemeID='ARACIKURUMVKN']">
											<tr>
												<td style="width:105px;" align="left">
													<span style="font-weight:bold; ">
														<xsl:text>Aracı Kurum VKN:</xsl:text>
													</span>
												</td>
												<td style="width:110px;" align="left">
													<xsl:value-of select="."/>
												</td>
											</tr>
											<tr>
												<td style="width:105px;" align="left">
													<span style="font-weight:bold; ">
														<xsl:text>Aracı Kurum Unvan:</xsl:text>
													</span>
												</td>
												<td style="width:110px;" align="left">
													<xsl:value-of select="../../cac:PartyName/cbc:Name"/>
												</td>
											</tr>
										</xsl:for-each>
									</tbody>
								</table>
							</td>
						</tr>
						<tr align="left">
							<table id="ettnTable">
								<tr style="height:13px;">
									<td align="left" valign="top">
										<span style="font-weight:bold; ">
											<xsl:text>ETTN:</xsl:text>
										</span>
									</td>
									<td align="left" width="240px">
										<xsl:for-each select="n1:Invoice">
											<xsl:for-each select="cbc:UUID">
												<xsl:apply-templates/>
											</xsl:for-each>
										</xsl:for-each>
									</td>
								</tr>
							</table>
						</tr>
						<xsl:if test="//n1:Invoice/cac:AccountingCustomerParty/cac:Party/cac:PartyIdentification/cbc:ID[@schemeID] ='7750409379'">
							<tr>
								<td>
									<br/>
								</td>
							</tr>
							<tr>
								<td>
									<table border="1">
										<tbody>
											<tr>
												<td style="width:105px; " align="left">
													<span style="font-weight:bold; ">
														<xsl:text>Sağlık Fatura Tipi:</xsl:text>
													</span>
												</td>
												<td align="left">
													<xsl:for-each select="n1:Invoice">
														<xsl:for-each select="cbc:AccountingCost">
															<xsl:apply-templates/>
														</xsl:for-each>
													</xsl:for-each>
												</td>
											</tr>
											<tr style="height:13px; ">
												<td align="left">
													<xsl:if test="//n1:Invoice/cbc:AccountingCost = 'SAGLIK_ECZ'">
														<span style="font-weight:bold; ">
															<xsl:text>Eczane Sicil No:</xsl:text>
														</span>
													</xsl:if>
													<xsl:if test="//n1:Invoice/cbc:AccountingCost != 'SAGLIK_ECZ'">
														<span style="font-weight:bold; ">
															<xsl:text>Mükellef Kodu:</xsl:text>
														</span>
													</xsl:if>
												</td>
												<td align="left">
													<xsl:for-each select="n1:Invoice">
														<xsl:for-each select="cac:AdditionalDocumentReference[cbc:DocumentTypeCode='MUKELLEF_KODU']/cbc:DocumentType">
															<xsl:apply-templates/>
														</xsl:for-each>
													</xsl:for-each>
												</td>
											</tr>
											<tr style="height:13px; ">
												<td align="left">
													<xsl:if test="//n1:Invoice/cbc:AccountingCost = 'SAGLIK_ECZ'">
														<span style="font-weight:bold; ">
															<xsl:text>Eczane Adı:</xsl:text>
														</span>
													</xsl:if>
													<xsl:if test="//n1:Invoice/cbc:AccountingCost != 'SAGLIK_ECZ'">
														<span style="font-weight:bold; ">
															<xsl:text>Mükellef Adı:</xsl:text>
														</span>
													</xsl:if>
												</td>
												<td align="left">
													<xsl:for-each select="n1:Invoice">
														<xsl:for-each select="cac:AdditionalDocumentReference[cbc:DocumentTypeCode='MUKELLEF_ADI']/cbc:DocumentType">
															<xsl:apply-templates/>
														</xsl:for-each>
													</xsl:for-each>
												</td>
											</tr>
											<tr style="height:13px; ">
												<td align="left">
													<xsl:if test="//n1:Invoice/cbc:AccountingCost = 'SAGLIK_ECZ'">
														<span style="font-weight:bold; ">
															<xsl:text>Döküm No:</xsl:text>
														</span>
													</xsl:if>
													<xsl:if test="//n1:Invoice/cbc:AccountingCost != 'SAGLIK_ECZ'">
														<span style="font-weight:bold; ">
															<xsl:text>Dosya No:</xsl:text>
														</span>
													</xsl:if>
												</td>
												<td align="left">
													<xsl:for-each select="n1:Invoice">
														<xsl:for-each select="cac:AdditionalDocumentReference[cbc:DocumentTypeCode='DOSYA_NO']/cbc:DocumentType">
															<xsl:apply-templates/>
														</xsl:for-each>
													</xsl:for-each>
												</td>
											</tr>
											<tr style="height:13px; ">
												<td align="left">
													<xsl:if test="//n1:Invoice/cbc:AccountingCost = 'SAGLIK_ECZ'">
														<span style="font-weight:bold; ">
															<xsl:text>Reçete Dönemi:</xsl:text>
														</span>
													</xsl:if>
													<xsl:if test="//n1:Invoice/cbc:AccountingCost != 'SAGLIK_ECZ'">
														<span style="font-weight:bold; ">
															<xsl:text>Dönem:</xsl:text>
														</span>
													</xsl:if>
												</td>
												<td align="left">
													<xsl:for-each select="n1:Invoice">
														<xsl:for-each select="cac:InvoicePeriod/cbc:StartDate">
															<xsl:apply-templates/>
														</xsl:for-each>
														<span>
															<xsl:text> / </xsl:text>
														</span>
														<xsl:for-each select="cac:InvoicePeriod/cbc:EndDate">
															<xsl:apply-templates/>
														</xsl:for-each>
													</xsl:for-each>
												</td>
											</tr>
										</tbody>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<br/>
								</td>
							</tr>
						</xsl:if>
					</table>
					<div id="lineTableAligner">
						<span>
							<xsl:text>&#160;</xsl:text>
						</span>
					</div>
					<table border="1" id="lineTable" width="800">
						<tbody>
							<tr id="lineTableTr">
								<td id="lineTableTd" style="width:3%">
									<span style="font-weight:bold; " align="center">
										<xsl:text>Sıra No</xsl:text>
									</span>
								</td>
								<xsl:if test="//n1:Invoice/cac:InvoiceLine/cac:Item/cac:SellersItemIdentification">
									<td id="lineTableTd" style="width:3%">
										<span style="font-weight:bold; " align="center">
											<xsl:text>Stok Kodu</xsl:text>
										</span>
									</td>
								</xsl:if>
								<td id="lineTableTd" style="width:20%" align="center">
									<span style="font-weight:bold; ">
										<xsl:text>Malzeme/Hizmet Açıklaması</xsl:text>
									</span>
								</td>
								<td id="lineTableTd" style="width:7.4%" align="center">
									<span style="font-weight:bold;">
										<xsl:text>Miktar</xsl:text>
									</span>
								</td>
								<td id="lineTableTd" style="width:9%" align="center">
									<span style="font-weight:bold; ">
										<xsl:text>Birim Fiyat</xsl:text>
									</span>
								</td>
								<xsl:if test="//n1:Invoice/cac:InvoiceLine/cac:AllowanceCharge/cbc:MultiplierFactorNumeric &gt;0">
									<td id="lineTableTd" style="width:7%" align="center">
										<span style="font-weight:bold; ">
											<xsl:text>İskonto Oranı&#160;%</xsl:text>
										</span>
									</td>
								</xsl:if>
								<xsl:if test="//n1:Invoice/cac:InvoiceLine/cac:AllowanceCharge/cbc:Amount &gt;0">
									<td id="lineTableTd" style="width:9%" align="center">
										<span style="font-weight:bold; ">
											<xsl:text>İskonto Tutarı&#160;&#160;</xsl:text>
										</span>
									</td>
								</xsl:if>
								<td id="lineTableTd" style="width:7%" align="center">
									<span style="font-weight:bold; ">
										<xsl:text>KDV Oranı</xsl:text>
									</span>
								</td>
								<td id="lineTableTd" style="width:10%" align="center">
									<span style="font-weight:bold; ">
										<xsl:text>KDV Tutarı</xsl:text>
									</span>
								</td>
								<xsl:if test="//n1:Invoice/cac:InvoiceLine/cac:WithholdingTaxTotal/cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme/cbc:TaxTypeCode!='0015'">
									<td id="lineTableTd" style="width:17%; " align="center">
										<span style="font-weight:bold; ">
											<xsl:text>Diğer Vergiler</xsl:text>
										</span>
									</td>
								</xsl:if>
								<td id="lineTableTd" style="width:10.6%" align="center">
									<span style="font-weight:bold; ">
										<xsl:text>Mal Hizmet Tutarı</xsl:text>
									</span>
								</td>
								<xsl:if test="//n1:Invoice/cbc:ProfileID='HKS'">
									<td id="lineTableTd" style="width:5%" align="center">
										<span style="font-weight:bold;">
											<xsl:text>Künye Numarası</xsl:text>
										</span>
									</td>
								</xsl:if>
								<xsl:if test="(//n1:Invoice/cbc:ProfileID='HKS' and /n1:Invoice/cbc:InvoiceTypeCode='SATIS') or (//n1:Invoice/cbc:ProfileID='HKS' and /n1:Invoice/cbc:InvoiceTypeCode='KOMISYONCU') ">
									<td id="lineTableTd" style="width:5%" align="center">
										<span style="font-weight:bold;">
											<xsl:text>Mal Sahibi VKN/TCKN - Ad/Soyad</xsl:text>
										</span>
									</td>
								</xsl:if>
								<xsl:if test="//n1:Invoice/cbc:ProfileID='IHRACAT'">
									<td id="lineTableTd" style="width:10.6%" align="center">
										<span style="font-weight:bold;">
											<xsl:text>Teslim Şartı</xsl:text>
										</span>
									</td>
									<td id="lineTableTd" style="width:10.6%" align="center">
										<span style="font-weight:bold;">
											<xsl:text>Eşya Kap Cinsi</xsl:text>
										</span>
									</td>
									<td id="lineTableTd" style="width:10.6%" align="center">
										<span style="font-weight:bold;">
											<xsl:text>Kap No</xsl:text>
										</span>
									</td>
									<td id="lineTableTd" style="width:10.6%" align="center">
										<span style="font-weight:bold;">
											<xsl:text>Kap Adet</xsl:text>
										</span>
									</td>
									<td id="lineTableTd" style="width:10.6%" align="center">
										<span style="font-weight:bold;">
											<xsl:text>Teslim/Bedel Ödeme Yeri</xsl:text>
										</span>
									</td>
									<td id="lineTableTd" style="width:10.6%" align="center">
										<span style="font-weight:bold;">
											<xsl:text>Gönderilme Şekli</xsl:text>
										</span>
									</td>
									<td id="lineTableTd" style="width:10.6%" align="center">
										<span style="font-weight:bold;">
											<xsl:text>GTİP</xsl:text>
										</span>
									</td>
								</xsl:if>
							</tr>
							<xsl:if test="count(//n1:Invoice/cac:InvoiceLine) &gt;= 6">
								<xsl:for-each select="//n1:Invoice/cac:InvoiceLine">
									<xsl:apply-templates select="."/>
								</xsl:for-each>
							</xsl:if>
							<xsl:if test="count(//n1:Invoice/cac:InvoiceLine) &lt; 6">
								<xsl:choose>
									<xsl:when test="//n1:Invoice/cac:InvoiceLine[1]">
										<xsl:apply-templates select="//n1:Invoice/cac:InvoiceLine[1]"/>
									</xsl:when>
									<xsl:otherwise>
										<xsl:apply-templates select="//n1:Invoice"/>
									</xsl:otherwise>
								</xsl:choose>
								<xsl:choose>
									<xsl:when test="//n1:Invoice/cac:InvoiceLine[2]">
										<xsl:apply-templates select="//n1:Invoice/cac:InvoiceLine[2]"/>
									</xsl:when>
									<xsl:otherwise>
										<xsl:apply-templates select="//n1:Invoice"/>
									</xsl:otherwise>
								</xsl:choose>
								<xsl:choose>
									<xsl:when test="//n1:Invoice/cac:InvoiceLine[3]">
										<xsl:apply-templates select="//n1:Invoice/cac:InvoiceLine[3]"/>
									</xsl:when>
									<xsl:otherwise>
										<xsl:apply-templates select="//n1:Invoice"/>
									</xsl:otherwise>
								</xsl:choose>
								<xsl:choose>
									<xsl:when test="//n1:Invoice/cac:InvoiceLine[4]">
										<xsl:apply-templates select="//n1:Invoice/cac:InvoiceLine[4]"/>
									</xsl:when>
									<xsl:otherwise>
										<xsl:apply-templates select="//n1:Invoice"/>
									</xsl:otherwise>
								</xsl:choose>
								<xsl:choose>
									<xsl:when test="//n1:Invoice/cac:InvoiceLine[5]">
										<xsl:apply-templates select="//n1:Invoice/cac:InvoiceLine[5]"/>
									</xsl:when>
									<xsl:otherwise>
										<xsl:apply-templates select="//n1:Invoice"/>
									</xsl:otherwise>
								</xsl:choose>
								<xsl:choose>
									<xsl:when test="//n1:Invoice/cac:InvoiceLine[6]">
										<xsl:apply-templates select="//n1:Invoice/cac:InvoiceLine[6]"/>
									</xsl:when>
									<xsl:otherwise>
										<xsl:apply-templates select="//n1:Invoice"/>
									</xsl:otherwise>
								</xsl:choose>
								<xsl:choose>
									<xsl:when test="//n1:Invoice/cac:InvoiceLine[7]">
										<xsl:apply-templates select="//n1:Invoice/cac:InvoiceLine[7]"/>
									</xsl:when>
									<xsl:otherwise>
										<xsl:apply-templates select="//n1:Invoice"/>
									</xsl:otherwise>
								</xsl:choose>
								<xsl:choose>
									<xsl:when test="//n1:Invoice/cac:InvoiceLine[8]">
										<xsl:apply-templates select="//n1:Invoice/cac:InvoiceLine[8]"/>
									</xsl:when>
									<xsl:otherwise>
										<xsl:apply-templates select="//n1:Invoice"/>
									</xsl:otherwise>
								</xsl:choose>
								<xsl:choose>
									<xsl:when test="//n1:Invoice/cac:InvoiceLine[9]">
										<xsl:apply-templates select="//n1:Invoice/cac:InvoiceLine[9]"/>
									</xsl:when>
									<xsl:otherwise>
										<xsl:apply-templates select="//n1:Invoice"/>
									</xsl:otherwise>
								</xsl:choose>
								<xsl:choose>
									<xsl:when test="//n1:Invoice/cac:InvoiceLine[10]">
										<xsl:apply-templates select="//n1:Invoice/cac:InvoiceLine[10]"/>
									</xsl:when>
									<xsl:otherwise>
										<xsl:apply-templates select="//n1:Invoice"/>
									</xsl:otherwise>
								</xsl:choose>
							</xsl:if>
						</tbody>
					</table>
				</xsl:for-each>
				<table id="budgetContainerTable" width="800px">
					<tbody>
						<tr>
							<xsl:if test="//n1:Invoice/cbc:ProfileID='HKS' and //n1:Invoice/cbc:InvoiceTypeCode='KOMISYONCU'">
								<td align="left" valign="top" width="300px ">
									<table border='1' cellpadding='0'>
										<tbody>
											<xsl:for-each select="n1:Invoice/cac:AllowanceCharge">
												<xsl:if test="cbc:AllowanceChargeReason = 'HKSKOMISYON'">
													<tr align="center">
														<span style="font-weight:bold; ">
															<th>Masraflar:</th>
															<th>Oran:</th>
															<th>Tutar:</th>
														</span>
													</tr>
													<tr align="left">
														<td class="lineTableBudgetTd" align="center" width="200px">
															<span style="font-weight:bold; ">
																<xsl:text>Komisyon </xsl:text>
															</span>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:MultiplierFactorNumeric">
																<xsl:text> %</xsl:text>
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:Amount">
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
													</tr>
												</xsl:if>
												<xsl:if test="cbc:AllowanceChargeReason = 'HKSKOMISYONKDV'">
													<tr align="right">
														<td class="lineTableBudgetTd" align="center" width="200px">
															<span style="font-weight:bold; ">
																<xsl:text>Komisyon KDV </xsl:text>
															</span>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:MultiplierFactorNumeric">
																<xsl:text> %</xsl:text>
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:Amount">
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
													</tr>
												</xsl:if>
												<xsl:if test="cbc:AllowanceChargeReason = 'HKSNAVLUN'">
													<tr align="right">
														<td class="lineTableBudgetTd" align="center" width="200px">
															<span style="font-weight:bold; ">
																<xsl:text>Navlun </xsl:text>
															</span>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:MultiplierFactorNumeric">
																<xsl:text> %</xsl:text>
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:Amount">
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
													</tr>
												</xsl:if>
												<xsl:if test="cbc:AllowanceChargeReason = 'HKSNAVLUNKDV'">
													<tr align="right">
														<td class="lineTableBudgetTd" align="center" width="200px">
															<span style="font-weight:bold; ">
																<xsl:text>Navlun KDV </xsl:text>
															</span>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:MultiplierFactorNumeric">
																<xsl:text> %</xsl:text>
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:Amount">
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
													</tr>
												</xsl:if>
												<xsl:if test="cbc:AllowanceChargeReason = 'HKSHAMMALIYE'">
													<tr align="right">
														<td class="lineTableBudgetTd" align="center" width="200px">
															<span style="font-weight:bold; ">
																<xsl:text>Hammaliye </xsl:text>
															</span>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:MultiplierFactorNumeric">
																<xsl:text> %</xsl:text>
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:Amount">
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
													</tr>
												</xsl:if>
												<xsl:if test="cbc:AllowanceChargeReason = 'HKSHAMMALIYEKDV'">
													<tr align="right">
														<td class="lineTableBudgetTd" align="center" width="200px">
															<span style="font-weight:bold; ">
																<xsl:text>Hammaliye KDV </xsl:text>
															</span>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:MultiplierFactorNumeric">
																<xsl:text> %</xsl:text>
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:Amount">
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
													</tr>
												</xsl:if>
												<xsl:if test="cbc:AllowanceChargeReason = 'HKSNAKLIYE'">
													<tr align="right">
														<td class="lineTableBudgetTd" align="center" width="200px">
															<span style="font-weight:bold; ">
																<xsl:text>Nakliye </xsl:text>
															</span>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:MultiplierFactorNumeric">
																<xsl:text> %</xsl:text>
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:Amount">
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
													</tr>
												</xsl:if>
												<xsl:if test="cbc:AllowanceChargeReason = 'HKSNAKLIYEKDV'">
													<tr align="right">
														<td class="lineTableBudgetTd" align="center" width="200px">
															<span style="font-weight:bold; ">
																<xsl:text>Nakliye KDV </xsl:text>
															</span>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:MultiplierFactorNumeric">
																<xsl:text> %</xsl:text>
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:Amount">
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
													</tr>
												</xsl:if>
												<xsl:if test="cbc:AllowanceChargeReason = 'HKSGVTEVKIFAT'">
													<tr align="right">
														<td class="lineTableBudgetTd" align="center" width="200px">
															<span style="font-weight:bold; ">
																<xsl:text>G.V. Tevkifat </xsl:text>
															</span>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:MultiplierFactorNumeric">
																<xsl:text> %</xsl:text>
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:Amount">
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
													</tr>
												</xsl:if>
												<xsl:if test="cbc:AllowanceChargeReason = 'HKSBAGKURTEVKIFAT'">
													<tr align="right">
														<td class="lineTableBudgetTd" align="center" width="200px">
															<span style="font-weight:bold; ">
																<xsl:text>Bağkur Tevkifat </xsl:text>
															</span>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:MultiplierFactorNumeric">
																<xsl:text> %</xsl:text>
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:Amount">
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
													</tr>
												</xsl:if>
												<xsl:if test="cbc:AllowanceChargeReason = 'HKSRUSUM'">
													<tr align="right">
														<td class="lineTableBudgetTd" align="center" width="200px">
															<span style="font-weight:bold; ">
																<xsl:text>Rüsum </xsl:text>
															</span>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:MultiplierFactorNumeric">
																<xsl:text> %</xsl:text>
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:Amount">
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
													</tr>
												</xsl:if>
												<xsl:if test="cbc:AllowanceChargeReason = 'HKSRUSUMKDV'">
													<tr align="right">
														<td class="lineTableBudgetTd" align="center" width="200px">
															<span style="font-weight:bold; ">
																<xsl:text>Rüsum KDV </xsl:text>
															</span>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:MultiplierFactorNumeric">
																<xsl:text> %</xsl:text>
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:Amount">
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
													</tr>
												</xsl:if>
												<xsl:if test="cbc:AllowanceChargeReason = 'HKSTICBORSASI'">
													<tr align="right">
														<td class="lineTableBudgetTd" align="center" width="200px">
															<span style="font-weight:bold; ">
																<xsl:text>Ticaret Borsası </xsl:text>
															</span>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:MultiplierFactorNumeric">
																<xsl:text> %</xsl:text>
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:Amount">
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
													</tr>
												</xsl:if>
												<xsl:if test="cbc:AllowanceChargeReason = 'HKSTICBORSASIKDV'">
													<tr align="right">
														<td class="lineTableBudgetTd" align="center" width="200px">
															<span style="font-weight:bold; ">
																<xsl:text>Ticaret Borsası KDV </xsl:text>
															</span>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:MultiplierFactorNumeric">
																<xsl:text> %</xsl:text>
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:Amount">
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
													</tr>
												</xsl:if>
												<xsl:if test="cbc:AllowanceChargeReason = 'HKSMILLISAVUNMAFON'">
													<tr align="right">
														<td class="lineTableBudgetTd" align="center" width="200px">
															<span style="font-weight:bold; ">
																<xsl:text>Milli Savunma Fon </xsl:text>
															</span>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:MultiplierFactorNumeric">
																<xsl:text> %</xsl:text>
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:Amount">
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
													</tr>
												</xsl:if>
												<xsl:if test="cbc:AllowanceChargeReason = 'HKSMSFONKDV'">
													<tr align="right">
														<td class="lineTableBudgetTd" align="center" width="200px">
															<span style="font-weight:bold; ">
																<xsl:text>Milli Savunma Fon KDV </xsl:text>
															</span>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:MultiplierFactorNumeric">
																<xsl:text> %</xsl:text>
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:Amount">
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
													</tr>
												</xsl:if>
												<xsl:if test="cbc:AllowanceChargeReason = 'HKSDIGERMASRAFLAR'">
													<tr align="right">
														<td class="lineTableBudgetTd" align="center" width="200px">
															<span style="font-weight:bold; ">
																<xsl:text>Diğer Masraflar </xsl:text>
															</span>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:MultiplierFactorNumeric">
																<xsl:text> %</xsl:text>
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:Amount">
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
													</tr>
												</xsl:if>
												<xsl:if test="cbc:AllowanceChargeReason = 'HKSDIGERKDV'">
													<tr align="right">
														<td class="lineTableBudgetTd" align="center" width="200px">
															<span style="font-weight:bold; ">
																<xsl:text>Diğer KDV </xsl:text>
															</span>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:MultiplierFactorNumeric">
																<xsl:text> %</xsl:text>
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
														<td class="lineTableBudgetTd" style="width:81px; " align="center">
															<xsl:for-each select="cbc:Amount">
																<xsl:call-template name="Curr_Type"/>
															</xsl:for-each>
														</td>
													</tr>
												</xsl:if>
											</xsl:for-each>
										</tbody>
									</table>
								</td>
							</xsl:if>
							<td valign="top">
								<table id="budgetContainerTable" width="350px" align='right'>
									<tr id="budgetContainerTr" align="right">
										<td id="budgetContainerDummyTd"/>
										<td id="lineTableBudgetTd" align="right" width="200px">
											<span style="font-weight:bold; ">
												<xsl:text>Mal Hizmet Toplam Tutarı</xsl:text>
											</span>
										</td>
										<td id="lineTableBudgetTd" style="width:81px; " align="right">
											<span>
												<xsl:value-of select="format-number(//n1:Invoice/cac:LegalMonetaryTotal/cbc:LineExtensionAmount, '###.##0,00', 'european')"/>
												<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:LineExtensionAmount/@currencyID">
													<xsl:text>
													</xsl:text>
													<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:LineExtensionAmount/@currencyID = 'TRY'">
														<xsl:text>TL</xsl:text>
													</xsl:if>
													<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:LineExtensionAmount/@currencyID != 'TRY'">
														<xsl:value-of select="//n1:Invoice/cac:LegalMonetaryTotal/cbc:LineExtensionAmount/@currencyID"/>
													</xsl:if>
												</xsl:if>
											</span>
										</td>
									</tr>
									<xsl:if test="//n1:Invoice/cac:Delivery/cac:Shipment/cbc:InsuranceValueAmount">
										<tr id="budgetContainerTr" align="right">
											<td id="budgetContainerDummyTd"/>
											<td id="lineTableBudgetTd" width="200px" align="right">
												<span style="font-weight:bold; ">
													<xsl:text>Sigorta Tutarı</xsl:text>
												</span>
											</td>
											<td id="lineTableBudgetTd" style="width:81px; " align="right">
												<span>
													<xsl:value-of select="format-number(//n1:Invoice/cac:Delivery/cac:Shipment/cbc:InsuranceValueAmount, '###.##0,00', 'european')"/>
													<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:LineExtensionAmount/@currencyID">
														<xsl:text>
														</xsl:text>
														<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:LineExtensionAmount/@currencyID = 'TRY'">
															<xsl:text>TL</xsl:text>
														</xsl:if>
														<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:LineExtensionAmount/@currencyID != 'TRY'">
															<xsl:value-of select="//n1:Invoice/cac:LegalMonetaryTotal/cbc:LineExtensionAmount/@currencyID"/>
														</xsl:if>
													</xsl:if>
												</span>
											</td>
										</tr>
									</xsl:if>
									<xsl:if test="//n1:Invoice/cac:Delivery/cac:Shipment/cbc:DeclaredForCarriageValueAmount">
										<tr id="budgetContainerTr" align="right">
											<td id="budgetContainerDummyTd"/>
											<td id="lineTableBudgetTd" width="200px" align="right">
												<span style="font-weight:bold; ">
													<xsl:text>Navlun Tutarı</xsl:text>
												</span>
											</td>
											<td id="lineTableBudgetTd" style="width:81px; " align="right">
												<span>
													<xsl:value-of select="format-number(//n1:Invoice/cac:Delivery/cac:Shipment/cbc:DeclaredForCarriageValueAmount, '###.##0,00', 'european')"/>
													<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:LineExtensionAmount/@currencyID">
														<xsl:text>
														</xsl:text>
														<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:LineExtensionAmount/@currencyID = 'TRY'">
															<xsl:text>TL</xsl:text>
														</xsl:if>
														<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:LineExtensionAmount/@currencyID != 'TRY'">
															<xsl:value-of select="//n1:Invoice/cac:LegalMonetaryTotal/cbc:LineExtensionAmount/@currencyID"/>
														</xsl:if>
													</xsl:if>
												</span>
											</td>
										</tr>
									</xsl:if>
									<tr id="budgetContainerTr" align="right">
										<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:AllowanceTotalAmount &gt;0">
											<td id="budgetContainerDummyTd"/>
											<td id="lineTableBudgetTd" align="right" width="200px">
												<xsl:if test="//n1:Invoice/cac:AllowanceCharge/cbc:ChargeIndicator">
													<span style="font-weight:bold; ">
														<xsl:text>Toplam İndirim İskonto</xsl:text>
													</span>
												</xsl:if>
											</td>
											<td id="lineTableBudgetTd" style="width:81px; " align="right">
												<span>
													<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:AllowanceTotalAmount &gt;0">
														<xsl:value-of select="format-number(//n1:Invoice/cac:LegalMonetaryTotal/cbc:AllowanceTotalAmount, '###.##0,00', 'european')"/>
														<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:AllowanceTotalAmount">
															<xsl:text>
															</xsl:text>
															<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:AllowanceTotalAmount/@currencyID = 'TRY'">
																<xsl:text>TL</xsl:text>
															</xsl:if>
															<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:AllowanceTotalAmount/@currencyID != 'TRY'">
																<xsl:value-of select="//n1:Invoice/cac:LegalMonetaryTotal/cbc:AllowanceTotalAmount/@currencyID"/>
															</xsl:if>
														</xsl:if>
													</xsl:if>
												</span>
											</td>
										</xsl:if>
									</tr>
									<xsl:if test="//n1:Invoice/cbc:ProfileID!='HKS' and //n1:Invoice/cbc:InvoiceTypeCode!='KOMISYONCU'">
										<tr id="budgetContainerTr" align="right">
											<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:ChargeTotalAmount &gt;0">
												<td id="budgetContainerDummyTd"/>
												<td id="lineTableBudgetTd" align="right" width="200px">
													<xsl:if test="//n1:Invoice/cac:AllowanceCharge/cbc:ChargeIndicator">
														<span style="font-weight:bold; ">
															<xsl:text>Toplam Arttırım İskonto</xsl:text>
														</span>
													</xsl:if>
												</td>
												<td id="lineTableBudgetTd" style="width:81px; " align="right">
													<span>
														<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:ChargeTotalAmount &gt;0">
															<xsl:value-of select="format-number(//n1:Invoice/cac:LegalMonetaryTotal/cbc:ChargeTotalAmount, '###.##0,00', 'european')"/>
															<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:ChargeTotalAmount">
																<xsl:text>
																</xsl:text>
																<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:ChargeTotalAmount/@currencyID = 'TRY'">
																	<xsl:text>TL</xsl:text>
																</xsl:if>
																<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:ChargeTotalAmount/@currencyID != 'TRY'">
																	<xsl:value-of select="//n1:Invoice/cac:LegalMonetaryTotal/cbc:ChargeTotalAmount/@currencyID"/>
																</xsl:if>
															</xsl:if>
														</xsl:if>
													</span>
												</td>
											</xsl:if>
										</tr>
									</xsl:if>
									<xsl:if test="(//n1:Invoice/cbc:ProfileID='HKS' and //n1:Invoice/cbc:InvoiceTypeCode='KOMISYONCU') or (//n1:Invoice/cbc:ProfileID='HKS' and //n1:Invoice/cbc:InvoiceTypeCode='SATIS')">
										<tr id="budgetContainerTr" align="right">
											<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:ChargeTotalAmount &gt;0">
												<td id="budgetContainerDummyTd"/>
												<td id="lineTableBudgetTd" width="200px" align="right">
													<span style="font-weight:bold; ">
														<xsl:text>Toplam Masraflar</xsl:text>
													</span>
												</td>
												<td id="lineTableBudgetTd" style="width:82px; " align="right">
													<xsl:for-each select="n1:Invoice/cac:LegalMonetaryTotal/cbc:ChargeTotalAmount">
														<xsl:call-template name="Curr_Type"/>
													</xsl:for-each>
												</td>
											</xsl:if>
										</tr>
									</xsl:if>
									<xsl:for-each select="n1:Invoice/cac:TaxTotal/cac:TaxSubtotal">
										<tr id="budgetContainerTr" align="right">
											<td id="budgetContainerDummyTd"/>
											<td id="lineTableBudgetTd" width="211px" align="right">
												<span style="font-weight:bold; ">
													<xsl:text>Hesaplanan </xsl:text>
													<xsl:value-of select="cac:TaxCategory/cac:TaxScheme/cbc:Name"/>
													<xsl:text>(%</xsl:text>
													<xsl:value-of select="cbc:Percent"/>
													<xsl:text>)</xsl:text>
												</span>
											</td>
											<td id="lineTableBudgetTd" style="width:82px; " align="right">
												<xsl:for-each select="cac:TaxCategory/cac:TaxScheme">
													<xsl:text>
													</xsl:text>
													<xsl:value-of select="format-number(../../cbc:TaxAmount, '###.##0,00', 'european')"/>
													<xsl:if test="../../cbc:TaxAmount/@currencyID">
														<xsl:text>
														</xsl:text>
														<xsl:if test="../../cbc:TaxAmount/@currencyID = 'TRY'">
															<xsl:text>TL</xsl:text>
														</xsl:if>
														<xsl:if test="../../cbc:TaxAmount/@currencyID != 'TRY'">
															<xsl:value-of select="../../cbc:TaxAmount/@currencyID"/>
														</xsl:if>
													</xsl:if>
												</xsl:for-each>
											</td>
										</tr>
									</xsl:for-each>
									<xsl:for-each select="n1:Invoice/cac:WithholdingTaxTotal/cac:TaxSubtotal">
										<tr id="budgetContainerTr" align="right">
											<td id="budgetContainerDummyTd"/>
											<td id="lineTableBudgetTd" width="211px" align="right">
												<span style="font-weight:bold; ">
													<xsl:text>Hesaplanan KDV Tevkifat</xsl:text>
													<xsl:text>(%</xsl:text>
													<xsl:value-of select="cbc:Percent"/>
													<xsl:text>)</xsl:text>
												</span>
											</td>
											<td id="lineTableBudgetTd" style="width:82px; " align="right">
												<xsl:for-each select="cac:TaxCategory/cac:TaxScheme">
													<xsl:text> </xsl:text>
													<xsl:value-of select="format-number(../../cbc:TaxAmount, '###.##0,00', 'european')"/>
													<xsl:if test="../../cbc:TaxAmount/@currencyID">
														<xsl:text> </xsl:text>
														<xsl:if test="../../cbc:TaxAmount/@currencyID = 'TRL' or ../../cbc:TaxAmount/@currencyID = 'TRY'">
															<xsl:text>TL</xsl:text>
														</xsl:if>
														<xsl:if test="../../cbc:TaxAmount/@currencyID != 'TRL' and ../../cbc:TaxAmount/@currencyID != 'TRY'">
															<xsl:value-of select="../../cbc:TaxAmount/@currencyID"/>
														</xsl:if>
													</xsl:if>
												</xsl:for-each>
											</td>
										</tr>
									</xsl:for-each>
									<xsl:if test="n1:Invoice/cac:InvoiceLine[cac:WithholdingTaxTotal/cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme]">
										<tr id="budgetContainerTr" align="right">
											<td id="budgetContainerDummyTd"/>
											<td id="lineTableBudgetTd" width="211px" align="right">
												<span style="font-weight:bold; ">
													<xsl:text>Tevkifata Tabi İşlem Tutarı</xsl:text>
												</span>
											</td>
											<td id="lineTableBudgetTd" style="width:82px; " align="right">
												<xsl:if test="n1:Invoice/cac:InvoiceLine[cac:WithholdingTaxTotal/cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme]">
													<xsl:value-of select="format-number(sum(n1:Invoice/cac:InvoiceLine[cac:WithholdingTaxTotal/cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme]/cbc:LineExtensionAmount), '###.##0,00', 'european')"/>
												</xsl:if>
												<xsl:if test="//n1:Invoice/cac:TaxTotal/cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme/cbc:TaxTypeCode=&apos;9015&apos;">
													<xsl:value-of select="format-number(sum(n1:Invoice/cac:InvoiceLine[cac:TaxTotal/cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme/cbc:TaxTypeCode=9015]/cbc:LineExtensionAmount), '###.##0,00', 'european')"/>
												</xsl:if>
												<xsl:if test="n1:Invoice/cbc:DocumentCurrencyCode = 'TRL' or n1:Invoice/cbc:DocumentCurrencyCode = 'TRY'">
													<xsl:text>&#160;TL</xsl:text>
												</xsl:if>
												<xsl:if test="n1:Invoice/cbc:DocumentCurrencyCode != 'TRL' and n1:Invoice/cbc:DocumentCurrencyCode != 'TRY'">
													<xsl:value-of select="n1:Invoice/cbc:DocumentCurrencyCode"/>
												</xsl:if>
											</td>
										</tr>
										<!-- 	<xsl:if test = "n1:Invoice/cac:InvoiceLine[cac:WithholdingTaxTotal/cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme]">
											<tr id="budgetContainerTr" align="right">
												<td id="budgetContainerDummyTd"/>
												<td id="lineTableBudgetTd" width="211px" align="right">
													<span style="font-weight:bold; ">
														<xsl:text>Tevkifata Tabi İşlem Tutarı</xsl:text>
													</span>
												</td>
												<td id="lineTableBudgetTd" style="width:82px; " align="right">
													<xsl:if test = "n1:Invoice/cac:InvoiceLine[cac:WithholdingTaxTotal/cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme]">
														<xsl:value-of
										select="format-number(sum(n1:Invoice/cac:InvoiceLine[cac:WithholdingTaxTotal/cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme]/cbc:LineExtensionAmount), '###.##0,00', 'european')"/>
													</xsl:if>
													<xsl:if test = "//n1:Invoice/cac:TaxTotal/cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme/cbc:TaxTypeCode=&apos;9015&apos;">
														<xsl:value-of
										select="format-number(sum(n1:Invoice/cac:InvoiceLine[cac:TaxTotal/cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme/cbc:TaxTypeCode=9015]/cbc:LineExtensionAmount), '###.##0,00', 'european')"/>
													</xsl:if>
													<xsl:if test="n1:Invoice/cbc:DocumentCurrencyCode = 'TRL' or n1:Invoice/cbc:DocumentCurrencyCode = 'TRY'">
														<xsl:text>&#160;TL</xsl:text>
													</xsl:if>
													<xsl:if test="n1:Invoice/cbc:DocumentCurrencyCode != 'TRL' and n1:Invoice/cbc:DocumentCurrencyCode != 'TRY'">
														<xsl:value-of select="n1:Invoice/cbc:DocumentCurrencyCode"/>
													</xsl:if>
												</td>
											</tr>
										</xsl:if> -->
									</xsl:if>
									<tr id="budgetContainerTr" align="right">
										<td id="budgetContainerDummyTd"/>
										<td id="lineTableBudgetTd" width="200px" align="right">
											<span style="font-weight:bold; ">
												<xsl:text>Vergiler Dahil Toplam Tutar</xsl:text>
											</span>
										</td>
										<td id="lineTableBudgetTd" style="width:82px; " align="right">
											<xsl:for-each select="n1:Invoice">
												<xsl:for-each select="cac:LegalMonetaryTotal">
													<xsl:for-each select="cbc:TaxInclusiveAmount">
														<xsl:value-of select="format-number(., '###.##0,00', 'european')"/>
														<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:TaxInclusiveAmount/@currencyID">
															<xsl:text>
															</xsl:text>
															<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:TaxInclusiveAmount/@currencyID = 'TRY'">
																<xsl:text>TL</xsl:text>
															</xsl:if>
															<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:TaxInclusiveAmount/@currencyID != 'TRY'">
																<xsl:value-of select="//n1:Invoice/cac:LegalMonetaryTotal/cbc:TaxInclusiveAmount/@currencyID"/>
															</xsl:if>
														</xsl:if>
													</xsl:for-each>
												</xsl:for-each>
											</xsl:for-each>
										</td>
									</tr>
									<tr id="budgetContainerTr" align="right">
										<td id="budgetContainerDummyTd"/>
										<td id="lineTableBudgetTd" width="200px" align="right">
											<span style="font-weight:bold; ">
												<xsl:text>Ödenecek Tutar</xsl:text>
											</span>
										</td>
										<td id="lineTableBudgetTd" style="width:82px; " align="right">
											<xsl:for-each select="n1:Invoice">
												<xsl:for-each select="cac:LegalMonetaryTotal">
													<xsl:for-each select="cbc:PayableAmount">
														<xsl:value-of select="format-number(., '###.##0,00', 'european')"/>
														<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:PayableAmount/@currencyID">
															<xsl:text>
															</xsl:text>
															<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:PayableAmount/@currencyID = 'TRY'">
																<xsl:text>TL</xsl:text>
															</xsl:if>
															<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:PayableAmount/@currencyID != 'TRY'">
																<xsl:value-of select="//n1:Invoice/cac:LegalMonetaryTotal/cbc:PayableAmount/@currencyID"/>
															</xsl:if>
														</xsl:if>
													</xsl:for-each>
												</xsl:for-each>
											</xsl:for-each>
										</td>
									</tr>
									<xsl:if test="//n1:Invoice/cac:PricingExchangeRate/cbc:CalculationRate">
										<tr id="budgetContainerTr" align="right">
											<td id="budgetContainerDummyTd"/>
											<td id="lineTableBudgetTd" width="200px" align="right">
												<span style="font-weight:bold; ">
													<xsl:text>Döviz Kuru</xsl:text>
												</span>
											</td>
											<td id="lineTableBudgetTd" style="width:82px; " align="right">
												<xsl:for-each select="n1:Invoice">
													<xsl:for-each select="cac:PricingExchangeRate">
														<xsl:for-each select="cbc:CalculationRate">
															<xsl:value-of select="format-number(., '###0,0000', 'european')"/>
															<xsl:if test="//n1:Invoice/cac:PricingExchangeRate/cbc:CalculationRate">
																<xsl:text>
																</xsl:text>
															</xsl:if>
														</xsl:for-each>
													</xsl:for-each>
												</xsl:for-each>
											</td>
										</tr>
									</xsl:if>
									<xsl:if test="//n1:Invoice/cac:LegalMonetaryTotal/cbc:LineExtensionAmount/@currencyID != 'TRY'">
										<tr align="right">
											<td/>
											<td id="lineTableBudgetTd" align="right" width="200px">
												<span style="font-weight:bold; ">
													<xsl:text>Mal Hizmet Toplam Tutarı(TL)</xsl:text>
												</span>
											</td>
											<td id="lineTableBudgetTd" style="width:81px; " align="right">
												<span>
													<xsl:value-of select="format-number(//n1:Invoice/cac:LegalMonetaryTotal/cbc:LineExtensionAmount * //n1:Invoice/cac:PricingExchangeRate/cbc:CalculationRate, '###.##0,00', 'european')"/>
													<xsl:text> TL</xsl:text>
												</span>
											</td>
										</tr>
										<tr id="budgetContainerTr" align="right">
											<td/>
											<td id="lineTableBudgetTd" width="200px" align="right">
												<span style="font-weight:bold; ">
													<xsl:text>Vergiler Dahil Toplam Tutar(TL)</xsl:text>
												</span>
											</td>
											<td id="lineTableBudgetTd" style="width:82px; " align="right">
												<xsl:value-of select="format-number(//n1:Invoice/cac:LegalMonetaryTotal/cbc:TaxInclusiveAmount * //n1:Invoice/cac:PricingExchangeRate/cbc:CalculationRate, '###.##0,00', 'european')"/>
												<xsl:text> TL</xsl:text>
											</td>
										</tr>
										<tr align="right">
											<td/>
											<td id="lineTableBudgetTd" width="200px" align="right">
												<span style="font-weight:bold; ">
													<xsl:text>Ödenecek Tutar(TL)</xsl:text>
												</span>
											</td>
											<td id="lineTableBudgetTd" style="width:82px; " align="right">
												<xsl:value-of select="format-number(//n1:Invoice/cac:LegalMonetaryTotal/cbc:PayableAmount * //n1:Invoice/cac:PricingExchangeRate/cbc:CalculationRate, '###.##0,00', 'european')"/>
												<xsl:text> TL</xsl:text>
											</td>
										</tr>
									</xsl:if>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
				<br/>
				<xsl:if test="//n1:Invoice/cac:BillingReference/cac:InvoiceDocumentReference/cbc:DocumentTypeCode[text()='İADE' or text()='IADE']">
					<table id="lineTable" width="800">
						<thead>
							<tr>
								<td align="left">
									<span style="font-weight:bold; " align="center">&#160;&#160;&#160;&#160;&#160;İadeye Konu Olan Faturalar</span>
								</td>
							</tr>
						</thead>
						<tbody>
							<tr align="left" class="lineTableTr">
								<td class="lineTableTd">
									<span style="font-weight:bold; " align="center">&#160;&#160;&#160;&#160;&#160;Fatura No</span>
								</td>
								<td class="lineTableTd">
									<span style="font-weight:bold; " align="center">&#160;&#160;&#160;&#160;&#160;Tarih</span>
								</td>
							</tr>
							<xsl:for-each select="//n1:Invoice/cac:BillingReference/cac:InvoiceDocumentReference/cbc:DocumentTypeCode[text()='İADE' or text()='IADE']">
								<tr align="left" class="lineTableTr">
									<td class="lineTableTd">&#160;&#160;&#160;&#160;&#160;
										<xsl:value-of select="../cbc:ID"/>
									</td>
									<td class="lineTableTd">&#160;&#160;&#160;&#160;&#160;
										<xsl:for-each select="../cbc:IssueDate">
											<xsl:apply-templates select="."/>
										</xsl:for-each>
									</td>
								</tr>
							</xsl:for-each>
						</tbody>
					</table>
				</xsl:if>
				<br/>
				<xsl:if test="//n1:Invoice/cac:BillingReference/cac:AdditionalDocumentReference/cbc:DocumentTypeCode='OKCBF'">
					<table border="1" id="lineTable" width="800">
						<thead>
							<tr>
								<th colspan="6">ÖKC Bilgileri</th>
							</tr>
						</thead>
						<tbody>
							<tr id="okcbfHeadTr" style="font-weight:bold;">
								<td style="width:20%">
									<xsl:text>Fiş Numarası</xsl:text>
								</td>
								<td style="width:10%" align="center">
									<xsl:text>Fiş Tarihi</xsl:text>
								</td>
								<td style="width:10%" align="center">
									<xsl:text>Fiş Saati</xsl:text>
								</td>
								<td style="width:40%" align="center">
									<xsl:text>Fiş Tipi</xsl:text>
								</td>
								<td style="width:10%" align="center">
									<xsl:text>Z Rapor No</xsl:text>
								</td>
								<td style="width:10%" align="center">
									<xsl:text>ÖKC Seri No</xsl:text>
								</td>
							</tr>
						</tbody>
						<xsl:for-each select="//n1:Invoice/cac:BillingReference/cac:AdditionalDocumentReference/cbc:DocumentTypeCode[text()='OKCBF']">
							<tr>
								<td style="width:20%">
									<xsl:value-of select="../cbc:ID"/>
								</td>
								<td style="width:10%" align="center">
									<xsl:value-of select="../cbc:IssueDate"/>
								</td>
								<td style="width:10%" align="center">
									<xsl:value-of select="substring(../cac:ValidityPeriod/cbc:StartTime,1,5)"/>
								</td>
								<td style="width:40%" align="center">
									<xsl:choose>
										<xsl:when test="../cbc:DocumentDescription='AVANS'">
											<xsl:text>Ön Tahsilat(Avans) Bilgi Fişi</xsl:text>
										</xsl:when>
										<xsl:when test="../cbc:DocumentDescription='YEMEK_FIS'">
											<xsl:text>Yemek Fişi/Kartı ile Yapılan Tahsilat Bilgi Fişi</xsl:text>
										</xsl:when>
										<xsl:when test="../cbc:DocumentDescription='E-FATURA'">
											<xsl:text>E-Fatura Bilgi Fişi</xsl:text>
										</xsl:when>
										<xsl:when test="../cbc:DocumentDescription='E-FATURA_IRSALIYE'">
											<xsl:text>İrsaliye Yerine Geçen E-Fatura Bilgi Fişi</xsl:text>
										</xsl:when>
										<xsl:when test="../cbc:DocumentDescription='E-ARSIV'">
											<xsl:text>E-Arşiv Bilgi Fişi</xsl:text>
										</xsl:when>
										<xsl:when test="../cbc:DocumentDescription='E-ARSIV_IRSALIYE'">
											<xsl:text>İrsaliye Yerine Geçen E-Arşiv Bilgi Fişi</xsl:text>
										</xsl:when>
										<xsl:when test="../cbc:DocumentDescription='FATURA'">
											<xsl:text>Faturalı Satış Bilgi Fişi</xsl:text>
										</xsl:when>
										<xsl:when test="../cbc:DocumentDescription='OTOPARK'">
											<xsl:text>Otopark Giriş Bilgi Fişi</xsl:text>
										</xsl:when>
										<xsl:when test="../cbc:DocumentDescription='FATURA_TAHSILAT'">
											<xsl:text>Fatura Tahsilat Bilgi Fişi</xsl:text>
										</xsl:when>
										<xsl:when test="../cbc:DocumentDescription='FATURA_TAHSILAT_KOMISYONLU'">
											<xsl:text>Komisyonlu Fatura Tahsilat Bilgi Fişi</xsl:text>
										</xsl:when>
										<xsl:otherwise>
											<xsl:text> </xsl:text>
										</xsl:otherwise>
									</xsl:choose>
								</td>
								<td style="width:10%" align="center">
									<xsl:value-of select="../cac:Attachment/cac:ExternalReference/cbc:URI"/>
								</td>
								<td style="width:10%" align="center">
									<xsl:value-of select="../cac:IssuerParty/cbc:EndpointID"/>
								</td>
							</tr>
						</xsl:for-each>
					</table>
					<br/>
				</xsl:if>
				<table id="notesTable" width="800" height="100">
					<tbody>
						<tr align="left">
							<td id="notesTableTd">
								<xsl:for-each select="//n1:Invoice/cac:TaxTotal/cac:TaxSubtotal">
									<xsl:if test="(cbc:Percent=0 and cac:TaxCategory/cac:TaxScheme/cbc:TaxTypeCode=&apos;0015&apos;) or (//n1:Invoice/cbc:InvoiceTypeCode='ISTISNA') or (//n1:Invoice/cbc:InvoiceTypeCode='IHRACKAYITLI') or (//n1:Invoice/cbc:InvoiceTypeCode='OZELMATRAH')">
										<b>Vergi İstisna Muafiyet Sebebi: </b>
										<xsl:value-of select="cac:TaxCategory/cbc:TaxExemptionReason"/>
										<br/>
									</xsl:if>
								</xsl:for-each>
								<xsl:for-each select="//n1:Invoice/cac:AllowanceCharge">
									<xsl:if test="cbc:AllowanceChargeReason!= '' and cbc:AllowanceChargeReason!= 'HKSKOMISYON' and cbc:AllowanceChargeReason!= 'HKSKOMISYONKDV' and cbc:AllowanceChargeReason!= 'HKSNAVLUN' and cbc:AllowanceChargeReason!= 'HKSNAVLUNKDV' and cbc:AllowanceChargeReason!= 'HKSHAMMALIYE' and cbc:AllowanceChargeReason!= 'HKSHAMMALIYEKDV' and cbc:AllowanceChargeReason!= 'HKSNAKLIYE' and cbc:AllowanceChargeReason!= 'HKSNAKLIYEKDV' and cbc:AllowanceChargeReason!= 'HKSGVTEVKIFAT' and cbc:AllowanceChargeReason!= 'HKSBAGKURTEVKIFAT' and cbc:AllowanceChargeReason!= 'HKSRUSUM' and cbc:AllowanceChargeReason!= 'HKSRUSUMKDV' and cbc:AllowanceChargeReason!= 'HKSTICBORSASI' and cbc:AllowanceChargeReason!= 'HKSTICBORSASIKDV' and cbc:AllowanceChargeReason!= 'HKSMILLISAVUNMAFON' and cbc:AllowanceChargeReason!= 'HKSMSFONKDV' and cbc:AllowanceChargeReason!= 'HKSDIGERMASRAFLAR' and cbc:AllowanceChargeReason!= 'HKSDIGERKDV'">
										<b>
											<xsl:value-of select="cbc:AllowanceChargeReason"/>
										</b> :&#160;
										<xsl:value-of select="cbc:Amount"/>
										<xsl:if test="cbc:Amount/@currencyID = 'TRY'">
											<xsl:text>TL</xsl:text>
										</xsl:if>
										<xsl:if test="cbc:Amount/@currencyID != 'TRY'">
											<xsl:value-of select="cbc:Amount/@currencyID"/>
										</xsl:if>
										<br/>
									</xsl:if>
								</xsl:for-each>
								<xsl:for-each select="//n1:Invoice/cac:WithholdingTaxTotal">
									<xsl:if test="//n1:Invoice/cac:WithholdingTaxTotal/cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme/cbc:Name">
										<b>Tevkifat  Sebebi: </b>
										<xsl:value-of select="//n1:Invoice/cac:WithholdingTaxTotal/cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme/cbc:TaxTypeCode"/>
										-
										<xsl:value-of select="//n1:Invoice/cac:WithholdingTaxTotal/cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme/cbc:Name"/>
										<br/>
									</xsl:if>
								</xsl:for-each>
								<br/>
								<b>Yalnız: </b>
								<xsl:for-each select="//n1:Invoice/cac:LegalMonetaryTotal/cbc:PayableAmount">
									<xsl:call-template name="dovizi_oku">
										<xsl:with-param name="doviz" select="@currencyID"/>
									</xsl:call-template>
								</xsl:for-each>
								<br/>
								<xsl:if test="$irsaliyeCount &gt; 1">
									<b> İrsaliyeler :  </b>
									<xsl:for-each select="//n1:Invoice/cac:DespatchDocumentReference[position() &gt; 1]">
										<xsl:value-of select="cbc:ID"/>-
										<xsl:for-each select="cbc:IssueDate">
											<xsl:value-of select="substring(.,9,2)"/>/<xsl:value-of select="substring(.,6,2)"/>/<xsl:value-of select="substring(.,1,4)"/>
										</xsl:for-each>
										<xsl:text>,&#160;&#160;</xsl:text>
									</xsl:for-each>
									<br/>
								</xsl:if>
								<xsl:if test="//n1:Invoice/cbc:Note">
									<br/>
									<xsl:for-each select="//n1:Invoice/cbc:Note">
										<b>Not : </b>
										<xsl:value-of select="."/>
										<br/>
									</xsl:for-each>
								</xsl:if>
								<xsl:if test="//n1:Invoice/cac:PaymentMeans/cbc:PaymentDueDate">
									<b> Ödeme Tarihi: </b>
									<xsl:value-of select="//n1:Invoice/cac:PaymentMeans/cbc:PaymentDueDate"/>
									<br/>
								</xsl:if>
								<xsl:if test="//n1:Invoice/cac:PaymentMeans/cac:PayeeFinancialAccount/cbc:PaymentNote">
									<b> Hesap Açıklaması: </b>
									<xsl:value-of select="//n1:Invoice/cac:PaymentMeans/cac:PayeeFinancialAccount/cbc:PaymentNote"/>
									<br/>
								</xsl:if>
								<xsl:if test="//n1:Invoice/cac:PaymentTerms/cbc:Note">
									<b> Ödeme Koşulu: </b>
									<xsl:value-of select="//n1:Invoice/cac:PaymentTerms/cbc:Note"/>
									<br/>
								</xsl:if>
								<xsl:if test="//n1:Invoice/cac:BuyerCustomerParty/cac:Party/cac:PartyIdentification/cbc:ID[@schemeID='PARTYTYPE']='TAXFREE' and //n1:Invoice/cac:TaxRepresentativeParty/cac:PartyTaxScheme/cbc:ExemptionReasonCode">
									<br/>
									<b>&#160;&#160;&#160;&#160;&#160; VAT OFF - NO CASH REFUND </b>
								</xsl:if>
								<xsl:if test="//n1:Invoice/cac:Delivery/cac:CarrierParty/cac:PartyName/cbc:Name">
									<b> Gönderiyi Taşıyan Unvan : </b>
									<xsl:value-of select="//n1:Invoice/cac:Delivery/cac:CarrierParty/cac:PartyName/cbc:Name"/>
									<br/>
								</xsl:if>
								<xsl:if test="//n1:Invoice/cac:Delivery/cac:CarrierParty/cac:PartyIdentification/cbc:ID">
									<b> Gönderiyi Taşıyan VKN/TCKN : </b>
									<xsl:value-of select="//n1:Invoice/cac:Delivery/cac:CarrierParty/cac:PartyIdentification/cbc:ID"/>
									<br/>
								</xsl:if>
								<xsl:if test="//n1:Invoice/cac:Delivery/cac:Despatch/cbc:ActualDespatchDate">
									<b> Gönderim Tarihi : </b>
									<xsl:value-of select="//n1:Invoice/cac:Delivery/cac:Despatch/cbc:ActualDespatchDate"/>
									<br/>
								</xsl:if>
								<xsl:if test="//n1:Invoice/cac:AdditionalDocumentReference/cbc:DocumentType = 'ELEKTRONIK' ">
									<span style="font-weight:bold;color:blue; ">
										<xsl:text>e-Arşiv izni kapsamında elektronik ortamda iletilmiştir.</xsl:text>
										<br/>
									</span>
								</xsl:if>
								<xsl:if test="//n1:Invoice/cac:Delivery  and //n1:Invoice/cbc:ProfileID!='IHRACAT'">
									<span style="font-weight:bold;color:blue; ">
										<xsl:text>Bu satış internet üzerinden yapılmıştır.</xsl:text>
									</span>
									<br/>
								</xsl:if>
								<xsl:if test="count(//n1:Invoice/cac:DespatchDocumentReference)=0">
									<span style="font-weight:bold;color:blue; ">
										<xsl:text>İrsaliye yerine geçer.</xsl:text>
									</span>
									<br/>
								</xsl:if>
							</td>
						</tr>
					</tbody>
				</table>
				<xsl:if test="//n1:Invoice/cac:PaymentMeans != ''">
					<table width="800px" border="2">
						<tr>
							<th>Banka Adı</th>
							<th>Şube Adı</th>
							<th>IBAN</th>
							<th>Para Birimi</th>
						</tr>
						<xsl:for-each select="n1:Invoice/cac:PaymentMeans">
							<tr align="center">
								<td>
									<xsl:value-of select="cac:PayeeFinancialAccount/cac:FinancialInstitutionBranch/cac:FinancialInstitution/cbc:Name"/>
								</td>
								<td>
									<xsl:value-of select="cac:PayeeFinancialAccount/cac:FinancialInstitutionBranch/cbc:Name"/>
								</td>
								<td>
									<xsl:value-of select="substring(cac:PayeeFinancialAccount/cbc:ID,1,4)"/>
									<xsl:text> </xsl:text>
									<xsl:value-of select="substring(cac:PayeeFinancialAccount/cbc:ID,5,4)"/>
									<xsl:text> </xsl:text>
									<xsl:value-of select="substring(cac:PayeeFinancialAccount/cbc:ID,9,4)"/>
									<xsl:text> </xsl:text>
									<xsl:value-of select="substring(cac:PayeeFinancialAccount/cbc:ID,13,4)"/>
									<xsl:text> </xsl:text>
									<xsl:value-of select="substring(cac:PayeeFinancialAccount/cbc:ID,17,4)"/>
									<xsl:text> </xsl:text>
									<xsl:value-of select="substring(cac:PayeeFinancialAccount/cbc:ID,21,4)"/>
									<xsl:text> </xsl:text>
									<xsl:value-of select="substring(cac:PayeeFinancialAccount/cbc:ID,25,2)"/>
								</td>
								<td>
									<xsl:value-of select="cac:PayeeFinancialAccount/cbc:CurrencyCode"/>
								</td>
							</tr>
						</xsl:for-each>
					</table>
				</xsl:if>
				<xsl:if test="//n1:Invoice/cac:AdditionalDocumentReference/cbc:DocumentType = 'INTERNET' and  //n1:Invoice/cac:AdditionalDocumentReference/cbc:DocumentTypeCode = 'EArchiveType'">
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<table border="1" align="left" id="lineTable" width="800">
						<tbody>
							<tr align="left">
								<td>
									<b>
										<xsl:text>İade Bölümü</xsl:text>
									</b>
								</td>
							</tr>
							<tr align="left" id="lineTableTr">
								<td id="lineTableTd" style="width:20%" align="center">
									<span style="font-weight:bold; ">
										<xsl:text>Malzeme/Hizmet Açıklaması</xsl:text>
									</span>
								</td>
								<td id="lineTableTd" style="width:7.4%" align="center">
									<span style="font-weight:bold;">
										<xsl:text>Miktar</xsl:text>
									</span>
								</td>
								<td id="lineTableTd" style="width:9%" align="center">
									<span style="font-weight:bold; ">
										<xsl:text>Birim Fiyat</xsl:text>
									</span>
								</td>
								<td id="lineTableTd" style="width:7%" align="center">
									<span style="font-weight:bold; ">
										<xsl:text>KDV Oranı</xsl:text>
									</span>
								</td>
								<td id="lineTableTd" style="width:10%" align="center">
									<span style="font-weight:bold; ">
										<xsl:text>KDV Tutarı</xsl:text>
									</span>
								</td>
								<td id="lineTableTd" style="width:10.6%" align="center">
									<span style="font-weight:bold; ">
										<xsl:text>Mal Hizmet Tutarı</xsl:text>
									</span>
								</td>
							</tr>
							<tr align="left">
								<td>
									<br/>
								</td>
								<br/>
								<td>
									<br/>
								</td>
								<br/>
								<td/>
								<br/>
								<td/>
								<br/>
								<td/>
								<td>
									<br/>
								</td>
							</tr>
							<tr align="left">
								<td>
									<br/>
								</td>
								<br/>
								<td>
									<br/>
								</td>
								<br/>
								<td/>
								<br/>
								<td/>
								<br/>
								<td/>
								<td>
									<br/>
								</td>
							</tr>
							<tr align="left">
								<td>
									<br/>
								</td>
								<br/>
								<td>
									<br/>
								</td>
								<br/>
								<td/>
								<br/>
								<td/>
								<br/>
								<td/>
								<td>
									<br/>
								</td>
							</tr>
						</tbody>
					</table>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<br/>
					<b>
						<xsl:text>Firma/Şahıs Unvanı :</xsl:text>
					</b>
					<br/>
					<b>
						<xsl:text>Vkn/Tckno :</xsl:text>
					</b>
					<br/>
					<b>
						<xsl:text>İmza Kaşe</xsl:text>
					</b>
					<br/>
				</xsl:if>
			</body>
		</html>
	</xsl:template>
	<xsl:template name="dovizi_oku">
		<xsl:param name="doviz"/>
		<xsl:variable name="okunacak" select="."/>
		<xsl:variable name="noktadan_sonra" select="round(($okunacak - floor($okunacak)) * 100)"/>
		<xsl:call-template name="sayi_oku">
			<xsl:with-param name="okunacak" select="."/>
		</xsl:call-template>
		<xsl:if test="$doviz">
			<xsl:choose>
				<xsl:when test="$doviz =  'TRL' or $doviz =  'TRY'">
					<xsl:value-of select="' Türk Lirası'"/>
					<xsl:if test="$noktadan_sonra &gt; 0">
						<xsl:value-of select="' '"/>
						<xsl:call-template name="sayi_oku">
							<xsl:with-param name="okunacak" select="$noktadan_sonra"/>
						</xsl:call-template>
						<xsl:value-of select="' Kuruş'"/>
					</xsl:if>
				</xsl:when>
				<xsl:when test="$doviz =  'EUR' or $doviz =  'EUR'">
					<xsl:value-of select="' EURO '"/>
					<xsl:if test="$noktadan_sonra &gt; 0">
						<xsl:value-of select="' '"/>
						<xsl:call-template name="sayi_oku">
							<xsl:with-param name="okunacak" select="$noktadan_sonra"/>
						</xsl:call-template>
						<xsl:value-of select="' Cent'"/>
					</xsl:if>
				</xsl:when>
				<xsl:when test="$doviz =  'USD' or $doviz =  'USD'">
					<xsl:value-of select="' USD '"/>
					<xsl:if test="$noktadan_sonra &gt; 0">
						<xsl:value-of select="' '"/>
						<xsl:call-template name="sayi_oku">
							<xsl:with-param name="okunacak" select="$noktadan_sonra"/>
						</xsl:call-template>
						<xsl:value-of select="' Cent'"/>
					</xsl:if>
				</xsl:when>
				<xsl:otherwise>
					<xsl:text>&#160;</xsl:text>
					<xsl:value-of select="$doviz"/>
					<xsl:if test="$noktadan_sonra &gt; 0">
						<xsl:value-of select="' '"/>
						<xsl:call-template name="sayi_oku">
							<xsl:with-param name="okunacak" select="$noktadan_sonra"/>
						</xsl:call-template>
					</xsl:if>
				</xsl:otherwise>
			</xsl:choose>
		</xsl:if>
	</xsl:template>
	<xsl:template name="sayi_oku">
		<xsl:param name="okunacak"/>
		<xsl:variable name="tam_sayi" select="floor($okunacak)"/>
		<xsl:variable name="birler" select="floor($okunacak) mod 10"/>
		<xsl:variable name="onlar" select="floor(floor($tam_sayi mod 100) div 10)"/>
		<xsl:variable name="yuzler" select="floor(floor($tam_sayi mod 1000) div 100)"/>
		<xsl:variable name="binler" select="floor(floor($tam_sayi mod 1000000) div 1000)"/>
		<xsl:variable name="milyonlar" select="floor(floor($tam_sayi mod 1000000000) div 1000000)"/>
		<xsl:variable name="milyarlar" select="floor(floor($tam_sayi mod 1000000000000) div 1000000000)"/>
		<xsl:if test="$milyarlar &gt; 0">
			<xsl:call-template name="sayi_oku_3hane">
				<xsl:with-param name="sayi" select="$milyarlar"/>
			</xsl:call-template> Milyar
		</xsl:if>
		<xsl:if test="$milyonlar &gt; 0">
			<xsl:call-template name="sayi_oku_3hane">
				<xsl:with-param name="sayi" select="$milyonlar"/>
			</xsl:call-template> Milyon
		</xsl:if>
		<xsl:if test="$binler &gt; 0">
			<xsl:if test="$binler = 1">Bin </xsl:if>
			<xsl:if test="$binler > 1">
				<xsl:call-template name="sayi_oku_3hane">
					<xsl:with-param name="sayi" select="$binler"/>
				</xsl:call-template> Bin
			</xsl:if>
		</xsl:if>
		<xsl:call-template name="yuzler_oku">
			<xsl:with-param name="sayi" select="$yuzler"/>
		</xsl:call-template>
		<xsl:call-template name="onlar_oku">
			<xsl:with-param name="sayi" select="$onlar"/>
		</xsl:call-template>
		<xsl:call-template name="birler_oku">
			<xsl:with-param name="sayi" select="$birler"/>
		</xsl:call-template>
	</xsl:template>
	<xsl:template name="sayi_oku_3hane">
		<xsl:param name="sayi"/>
		<xsl:variable name="tam_sayi" select="floor($sayi)"/>
		<xsl:variable name="birler" select="floor($sayi) mod 10"/>
		<xsl:variable name="onlar" select="floor(floor($tam_sayi mod 100) div 10)"/>
		<xsl:variable name="yuzler" select="floor(floor($tam_sayi mod 1000) div 100)"/>
		<xsl:call-template name="yuzler_oku">
			<xsl:with-param name="sayi" select="$yuzler"/>
		</xsl:call-template>
		<xsl:call-template name="onlar_oku">
			<xsl:with-param name="sayi" select="$onlar"/>
		</xsl:call-template>
		<xsl:call-template name="birler_oku">
			<xsl:with-param name="sayi" select="$birler"/>
		</xsl:call-template>
	</xsl:template>
	<xsl:template name="birler_oku">
		<xsl:param name="sayi"/>
		<xsl:choose>
			<xsl:when test="$sayi =  1">Bir </xsl:when>
			<xsl:when test="$sayi =  2">İki </xsl:when>
			<xsl:when test="$sayi =  3">Üç </xsl:when>
			<xsl:when test="$sayi =  4">Dört </xsl:when>
			<xsl:when test="$sayi =  5">Beş </xsl:when>
			<xsl:when test="$sayi =  6">Altı </xsl:when>
			<xsl:when test="$sayi =  7">Yedi </xsl:when>
			<xsl:when test="$sayi =  8">Sekiz </xsl:when>
			<xsl:when test="$sayi =  9">Dokuz </xsl:when>
			<xsl:otherwise> </xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	<xsl:template name="onlar_oku">
		<xsl:param name="sayi"/>
		<xsl:choose>
			<xsl:when test="$sayi =  1">On </xsl:when>
			<xsl:when test="$sayi =  2">Yirmi </xsl:when>
			<xsl:when test="$sayi =  3">Otuz </xsl:when>
			<xsl:when test="$sayi =  4">Kırk </xsl:when>
			<xsl:when test="$sayi =  5">Elli </xsl:when>
			<xsl:when test="$sayi =  6">Altmış </xsl:when>
			<xsl:when test="$sayi =  7">Yetmiş </xsl:when>
			<xsl:when test="$sayi =  8">Seksen </xsl:when>
			<xsl:when test="$sayi =  9">Doksan </xsl:when>
			<xsl:otherwise/>
		</xsl:choose>
	</xsl:template>
	<xsl:template name="yuzler_oku">
		<xsl:param name="sayi"/>
		<xsl:choose>
			<xsl:when test="$sayi =  1">Yüz </xsl:when>
			<xsl:when test="$sayi =  2">İki Yüz </xsl:when>
			<xsl:when test="$sayi =  3">Üç Yüz </xsl:when>
			<xsl:when test="$sayi =  4">Dört Yüz </xsl:when>
			<xsl:when test="$sayi =  5">Beş Yüz </xsl:when>
			<xsl:when test="$sayi =  6">Altı Yüz </xsl:when>
			<xsl:when test="$sayi =  7">Yedi Yüz </xsl:when>
			<xsl:when test="$sayi =  8">Sekiz Yüz </xsl:when>
			<xsl:when test="$sayi =  9">Dokuz Yüz </xsl:when>
			<xsl:otherwise/>
		</xsl:choose>
	</xsl:template>
	<xsl:template name="binler_oku">
		<xsl:param name="sayi"/>
		<xsl:choose>
			<xsl:when test="$sayi =  1">Bin </xsl:when>
			<xsl:when test="$sayi =  2">İki Bin </xsl:when>
			<xsl:when test="$sayi =  3">Üç Bin </xsl:when>
			<xsl:when test="$sayi =  4">Dört Bin </xsl:when>
			<xsl:when test="$sayi =  5">Beş Bin </xsl:when>
			<xsl:when test="$sayi =  6">Altı Bin </xsl:when>
			<xsl:when test="$sayi =  7">Yedi Bin </xsl:when>
			<xsl:when test="$sayi =  8">Sekiz Bin </xsl:when>
			<xsl:when test="$sayi =  9">Dokuz Bin </xsl:when>
			<xsl:otherwise/>
		</xsl:choose>
	</xsl:template>
	<xsl:template name="onbinler_oku">
		<xsl:param name="sayi"/>
		<xsl:if test="$sayi &gt; 0">
			<xsl:call-template name="onlar_oku">
				<xsl:with-param name="sayi" select="$sayi"/>
			</xsl:call-template>Bin
		</xsl:if>
	</xsl:template>
	<xsl:template name="parcala">
		<xsl:param name="csv"/>
		<xsl:param name="isaret"/>
		<xsl:variable name="first-item" select="normalize-space(substring-before( concat( $csv, '|'), '|'))"/>
		<xsl:if test="$csv">
			<xsl:if test="normalize-space(substring-after(concat($first-item, ''), $isaret))">
				<xsl:value-of disable-output-escaping="yes" select="normalize-space(substring-after(concat($first-item, ''), $isaret))"/>
			</xsl:if>
			<xsl:call-template name="parcala">
				<xsl:with-param name="csv" select="substring-after($csv,'|')"/>
				<xsl:with-param name="isaret" select="$isaret"/>
			</xsl:call-template>
		</xsl:if>
	</xsl:template>
	<xsl:template match="dateFormatter">
		<xsl:value-of select="substring(.,9,2)"/>-<xsl:value-of select="substring(.,6,2)"/>-<xsl:value-of select="substring(.,1,4)"/>
	</xsl:template>
	<xsl:template match="//n1:Invoice/cac:InvoiceLine">
		<tr id="lineTableTr">
			<td id="lineTableTd">
				<span>
					<xsl:text>&#160;</xsl:text>
					<xsl:value-of select="./cbc:ID"/>
				</span>
			</td>
			<xsl:if test="//n1:Invoice/cac:InvoiceLine/cac:Item/cac:SellersItemIdentification">
				<td id="lineTableTd">
					<span>
						<xsl:text>&#160;</xsl:text>
						<xsl:value-of select="./cac:Item/cac:SellersItemIdentification/cbc:ID"/>
					</span>
				</td>
			</xsl:if>
			<td id="lineTableTd">
				<span>
					<xsl:text>&#160;</xsl:text>
					<xsl:value-of select="./cac:Item/cbc:Name"/>
				</span>
			</td>
			<td id="lineTableTd" align="right">
				<span>
					<xsl:text>&#160;</xsl:text>
					<xsl:value-of select="format-number(./cbc:InvoicedQuantity, '###.###,####', 'european')"/>
					<xsl:if test="./cbc:InvoicedQuantity/@unitCode">
						<xsl:for-each select="./cbc:InvoicedQuantity">
							<xsl:text>
							</xsl:text>
							<xsl:choose>
								<xsl:when test="@unitCode  = '26'">
									<span>
										<xsl:text>Ton</xsl:text>
									</span>
								</xsl:when>
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
				</span>
			</td>
			<td id="lineTableTd" align="right">
				<span>
					<xsl:text>&#160;</xsl:text>
					<xsl:value-of select="format-number(./cac:Price/cbc:PriceAmount, '###.##0,########', 'european')"/>
					<xsl:if test="./cac:Price/cbc:PriceAmount/@currencyID">
						<xsl:text> </xsl:text>
						<xsl:if test="./cac:Price/cbc:PriceAmount/@currencyID = &quot;TRL&quot; or ./cac:Price/cbc:PriceAmount/@currencyID = &quot;TRY&quot;">
							<xsl:text>TL</xsl:text>
						</xsl:if>
						<xsl:if test="./cac:Price/cbc:PriceAmount/@currencyID != &quot;TRL&quot; and ./cac:Price/cbc:PriceAmount/@currencyID != &quot;TRY&quot;">
							<xsl:value-of select="./cac:Price/cbc:PriceAmount/@currencyID"/>
						</xsl:if>
					</xsl:if>
				</span>
			</td>
			<xsl:if test="//n1:Invoice/cac:InvoiceLine/cac:AllowanceCharge/cbc:MultiplierFactorNumeric &gt;0">
				<xsl:if test="$iskontoCount &gt; 2">
					<td id="lineTableTd" align="right" width="75">
						<xsl:text>&#160;</xsl:text>
						<xsl:for-each select="./cac:AllowanceCharge/cbc:MultiplierFactorNumeric">
							<xsl:variable name="position" select="position()"/>
							<xsl:value-of select="format-number(. * 100, '###.##0,00', 'european')"/>
							<xsl:if test="$iskontoCount &gt; $position">
								<xsl:text> +</xsl:text>
							</xsl:if>
						</xsl:for-each>
					</td>
				</xsl:if>
				<xsl:if test="$iskontoCount &lt; 2">
					<td id="lineTableTd" align="right">
						<xsl:text>&#160;</xsl:text>
						<xsl:for-each select="./cac:AllowanceCharge/cbc:MultiplierFactorNumeric">
							<xsl:variable name="position" select="position()"/>
							<xsl:value-of select="format-number(. * 100, '###.##0,00', 'european')"/>
							<xsl:if test="$iskontoCount &gt; $position">
								<xsl:text> +</xsl:text>
							</xsl:if>
						</xsl:for-each>
					</td>
				</xsl:if>
				<xsl:if test="$iskontoCount = 2">
					<td id="lineTableTd" align="right" width="100">
						<xsl:text>&#160;</xsl:text>
						<xsl:for-each select="./cac:AllowanceCharge/cbc:MultiplierFactorNumeric">
							<xsl:variable name="position" select="position()"/>
							<xsl:value-of select="format-number(. * 100, '###.##0,00', 'european')"/>
							<xsl:if test="$iskontoCount &gt; $position">
								<xsl:text> +</xsl:text>
							</xsl:if>
						</xsl:for-each>
					</td>
				</xsl:if>
			</xsl:if>
			<xsl:if test="//n1:Invoice/cac:InvoiceLine/cac:AllowanceCharge/cbc:Amount &gt;0">
				<td align="right">
					<xsl:for-each select="./cac:AllowanceCharge">
						<xsl:if test=".">
							<xsl:value-of select="format-number(./cbc:Amount, '###.##0,00', 'european')"/>
						</xsl:if>
						<xsl:if test="./cbc:Amount/@currencyID">
							<xsl:if test="./cbc:Amount/@currencyID = 'TRY'">
								<xsl:text> TL</xsl:text>
							</xsl:if>
							<xsl:if test="./cbc:Amount/@currencyID != 'TRY'">
								<xsl:value-of select="./cbc:Amount/@currencyID"/>
							</xsl:if>
						</xsl:if>
						<xsl:variable name="position" select="position()"/>
						<xsl:if test="$iskontoCount &gt; $position">
							<xsl:text> +</xsl:text>
						</xsl:if>
					</xsl:for-each>
				</td>
			</xsl:if>
			<td id="lineTableTd" align="right">
				<span>
					<xsl:text>&#160;</xsl:text>
					<xsl:for-each select="./cac:TaxTotal/cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme">
						<xsl:if test="cbc:TaxTypeCode='0015' ">
							<xsl:text>
							</xsl:text>
							<xsl:if test="../../cbc:Percent">
								<xsl:text> %</xsl:text>
								<xsl:value-of select="format-number(../../cbc:Percent, '###.##0,00', 'european')"/>
							</xsl:if>
						</xsl:if>
					</xsl:for-each>
				</span>
			</td>
			<td id="lineTableTd" align="right">
				<span>
					<xsl:text>&#160;</xsl:text>
					<xsl:for-each select="./cac:TaxTotal/cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme">
						<xsl:if test="cbc:TaxTypeCode='0015' ">
							<xsl:text>
							</xsl:text>
							<xsl:value-of select="format-number(../../cbc:TaxAmount, '###.##0,00', 'european')"/>
							<xsl:if test="../../cbc:TaxAmount/@currencyID">
								<xsl:text>
								</xsl:text>
								<xsl:if test="../../cbc:TaxAmount/@currencyID = 'TRY'">
									<xsl:text>TL</xsl:text>
								</xsl:if>
								<xsl:if test="../../cbc:TaxAmount/@currencyID != 'TRY'">
									<xsl:value-of select="../../cbc:TaxAmount/@currencyID"/>
								</xsl:if>
							</xsl:if>
						</xsl:if>
					</xsl:for-each>
				</span>
			</td>
			<xsl:if test="//n1:Invoice/cac:InvoiceLine/cac:WithholdingTaxTotal/cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme/cbc:TaxTypeCode!='0015'">
				<td id="lineTableTd" style="font-size: xx-small" align="right">
					<span>
						<xsl:text>&#160;</xsl:text>
						<xsl:for-each select="./cac:TaxTotal/cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme">
							<xsl:if test="cbc:TaxTypeCode!='0015' ">
								<xsl:text>
								</xsl:text>
								<xsl:value-of select="cbc:Name"/>
								<xsl:if test="../../cbc:Percent">
									<xsl:text> (%</xsl:text>
									<xsl:value-of select="format-number(../../cbc:Percent, '###.##0,00', 'european')"/>
									<xsl:text>)=</xsl:text>
								</xsl:if>
								<xsl:value-of select="format-number(../../cbc:TaxAmount, '###.##0,00', 'european')"/>
								<xsl:if test="../../cbc:TaxAmount/@currencyID">
									<xsl:text>
									</xsl:text>
									<xsl:if test="../../cbc:TaxAmount/@currencyID = 'TRY'">
										<xsl:text>TL</xsl:text>
									</xsl:if>
									<xsl:if test="../../cbc:TaxAmount/@currencyID != 'TRY'">
										<xsl:value-of select="../../cbc:TaxAmount/@currencyID"/>
									</xsl:if>
								</xsl:if>
							</xsl:if>
						</xsl:for-each>
						<xsl:for-each select="./cac:WithholdingTaxTotal/cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme">
							<xsl:text>KDV TEVKİFAT </xsl:text>
							<xsl:if test="../../cbc:Percent">
								<xsl:text> (%</xsl:text>
								<xsl:value-of select="format-number(../../cbc:Percent, '###.##0,00', 'european')"/>
								<xsl:text>)=</xsl:text>
							</xsl:if>
							<xsl:value-of select="format-number(../../cbc:TaxAmount, '###.##0,00', 'european')"/>
							<xsl:if test="../../cbc:TaxAmount/@currencyID">
								<xsl:text> </xsl:text>
								<xsl:if test="../../cbc:TaxAmount/@currencyID = 'TRL' or ../../cbc:TaxAmount/@currencyID = 'TRY'">
									<xsl:text>TL</xsl:text>
									<xsl:text>&#10;</xsl:text>
								</xsl:if>
								<xsl:if test="../../cbc:TaxAmount/@currencyID != 'TRL' and ../../cbc:TaxAmount/@currencyID != 'TRY'">
									<xsl:value-of select="../../cbc:TaxAmount/@currencyID"/>
									<xsl:text>&#10;</xsl:text>
								</xsl:if>
							</xsl:if>
						</xsl:for-each>
					</span>
				</td>
			</xsl:if>
			<td id="lineTableTd" align="right">
				<span>
					<xsl:text>&#160;</xsl:text>
					<xsl:value-of select="format-number(./cbc:LineExtensionAmount, '###.##0,00', 'european')"/>
					<xsl:if test="./cbc:LineExtensionAmount/@currencyID">
						<xsl:text>
						</xsl:text>
						<xsl:if test="./cbc:LineExtensionAmount/@currencyID = 'TRY' ">
							<xsl:text>TL</xsl:text>
						</xsl:if>
						<xsl:if test="./cbc:LineExtensionAmount/@currencyID != 'TRY' ">
							<xsl:value-of select="./cbc:LineExtensionAmount/@currencyID"/>
						</xsl:if>
					</xsl:if>
				</span>
			</td>
			<xsl:if test="//n1:Invoice/cbc:ProfileID='HKS'">
				<td id="lineTableTd" align="right">
					<span>
						<xsl:text>&#160;</xsl:text>
						<xsl:for-each select="cac:Item/cac:AdditionalItemIdentification/cbc:ID[@schemeID='KUNYENO']">
							<xsl:text>&#160;</xsl:text>
							<xsl:apply-templates/>
						</xsl:for-each>
					</span>
				</td>
			</xsl:if>
			<xsl:if test="(//n1:Invoice/cbc:ProfileID='HKS' and /n1:Invoice/cbc:InvoiceTypeCode='SATIS') or (//n1:Invoice/cbc:ProfileID='HKS' and /n1:Invoice/cbc:InvoiceTypeCode='KOMISYONCU')">
				<td id="lineTableTd" align="right">
					<span>
						<xsl:text>&#160;</xsl:text>
						<xsl:for-each select="cac:Item/cac:AdditionalItemIdentification/cbc:ID[@schemeID='MALSAHIBIVKNTCKN']">
							<xsl:text>&#160;</xsl:text>
							<xsl:apply-templates/>
							<br/>
						</xsl:for-each>
						<xsl:for-each select="cac:Item/cac:AdditionalItemIdentification/cbc:ID[@schemeID='MALSAHIBIADSOYADUNVAN']">
							<xsl:text>&#160;</xsl:text>
							<xsl:apply-templates/>
						</xsl:for-each>
					</span>
				</td>
			</xsl:if>
			<xsl:if test="//n1:Invoice/cbc:ProfileID='IHRACAT'">
				<td id="lineTableTd" align="right">
					<xsl:text>&#160;</xsl:text>
					<xsl:for-each select="cac:Delivery/cac:DeliveryTerms/cbc:ID[@schemeID='INCOTERMS']">
						<xsl:text>&#160;</xsl:text>
						<xsl:apply-templates/>
					</xsl:for-each>
				</td>
				<td id="lineTableTd" align="right">
					<xsl:text>&#160;</xsl:text>
					<xsl:for-each select="cac:Delivery/cac:Shipment/cac:TransportHandlingUnit/cac:ActualPackage/cbc:PackagingTypeCode">
						<xsl:text>&#160;</xsl:text>
						<xsl:call-template name="Packaging">
							<xsl:with-param name="PackagingType">
								<xsl:value-of select="."/>
							</xsl:with-param>
						</xsl:call-template>
					</xsl:for-each>
				</td>
				<td id="lineTableTd" align="right">
					<xsl:text>&#160;</xsl:text>
					<xsl:for-each select="cac:Delivery/cac:Shipment/cac:TransportHandlingUnit/cac:ActualPackage/cbc:ID">
						<xsl:text>&#160;</xsl:text>
						<xsl:apply-templates/>
					</xsl:for-each>
				</td>
				<td id="lineTableTd" align="right">
					<xsl:text>&#160;</xsl:text>
					<xsl:for-each select="cac:Delivery/cac:Shipment/cac:TransportHandlingUnit/cac:ActualPackage/cbc:Quantity">
						<xsl:text>&#160;</xsl:text>
						<xsl:apply-templates/>
					</xsl:for-each>
				</td>
				<td id="lineTableTd" align="right">
					<xsl:text>&#160;</xsl:text>
					<xsl:for-each select="cac:Delivery/cac:DeliveryAddress">
						<xsl:text>&#160;</xsl:text>
						<xsl:apply-templates/>
					</xsl:for-each>
				</td>
				<td id="lineTableTd" align="right">
					<xsl:text>&#160;</xsl:text>
					<xsl:for-each select="cac:Delivery/cac:Shipment/cac:ShipmentStage/cbc:TransportModeCode">
						<xsl:text>&#160;</xsl:text>
						<xsl:call-template name="TransportMode">
							<xsl:with-param name="TransportModeType">
								<xsl:value-of select="."/>
							</xsl:with-param>
						</xsl:call-template>
					</xsl:for-each>
				</td>
				<td id="lineTableTd" align="right">
					<xsl:text>&#160;</xsl:text>
					<xsl:for-each select="cac:Delivery/cac:Shipment/cac:GoodsItem/cbc:RequiredCustomsID">
						<xsl:text>&#160;</xsl:text>
						<xsl:apply-templates/>
					</xsl:for-each>
				</td>
			</xsl:if>
		</tr>
	</xsl:template>
	<xsl:template match="//n1:Invoice">
		<tr id="lineTableTr">
			<td id="lineTableTd">
				<span>
					<xsl:text>&#160;</xsl:text>
				</span>
			</td>
			<xsl:if test="//n1:Invoice/cac:InvoiceLine/cac:Item/cac:SellersItemIdentification">
				<td id="lineTableTd">
					<span>
						<xsl:text>&#160;</xsl:text>
					</span>
				</td>
			</xsl:if>
			<td id="lineTableTd">
				<span>
					<xsl:text>&#160;</xsl:text>
				</span>
			</td>
			<td id="lineTableTd" align="right">
				<span>
					<xsl:text>&#160;</xsl:text>
				</span>
			</td>
			<td id="lineTableTd" align="right">
				<span>
					<xsl:text>&#160;</xsl:text>
				</span>
			</td>
			<xsl:if test="//n1:Invoice/cac:InvoiceLine/cac:AllowanceCharge/cbc:MultiplierFactorNumeric &gt;0">
				<td id="lineTableTd" align="right">
					<span>
						<xsl:text>&#160;</xsl:text>
					</span>
				</td>
			</xsl:if>
			<xsl:if test="//n1:Invoice/cac:InvoiceLine/cac:AllowanceCharge/cbc:Amount &gt;0">
				<td id="lineTableTd" align="right">
					<span>
						<xsl:text>&#160;</xsl:text>
					</span>
				</td>
			</xsl:if>
			<td id="lineTableTd" align="right">
				<span>
					<xsl:text>&#160;</xsl:text>
				</span>
			</td>
			<td id="lineTableTd" align="right">
				<span>
					<xsl:text>&#160;</xsl:text>
				</span>
			</td>
			<xsl:if test="//n1:Invoice/cac:InvoiceLine/cac:WithholdingTaxTotal/cac:TaxSubtotal/cac:TaxCategory/cac:TaxScheme/cbc:TaxTypeCode!='0015'">
				<td id="lineTableTd" align="right">
					<span>
						<xsl:text>&#160;</xsl:text>
					</span>
				</td>
			</xsl:if>
			<td id="lineTableTd" align="right">
				<span>
					<xsl:text>&#160;</xsl:text>
				</span>
			</td>
			<xsl:if test="//n1:Invoice/cbc:ProfileID='HKS'">
				<td id="lineTableTd" align="right">
					<span>
						<xsl:text>&#160;</xsl:text>
					</span>
				</td>
			</xsl:if>
			<xsl:if test="(//n1:Invoice/cbc:ProfileID='HKS' and //n1:Invoice/cbc:InvoiceTypeCode='SATIS') or (//n1:Invoice/cbc:ProfileID='HKS' and /n1:Invoice/cbc:InvoiceTypeCode='KOMISYONCU')">
				<td id="lineTableTd" align="right">
					<span>
						<xsl:text>&#160;</xsl:text>
						<br/>
					</span>
				</td>
				<!-- <td id="lineTableTd" align="right">
				<span>
					<xsl:text>&#160;</xsl:text>
				</span>
			</td> -->
			</xsl:if>
			<xsl:if test="//n1:Invoice/cbc:ProfileID='IHRACAT'">
				<td id="lineTableTd" align="right">
					<xsl:text>&#160;</xsl:text>
				</td>
				<td id="lineTableTd" align="right">
					<xsl:text>&#160;</xsl:text>
				</td>
				<td id="lineTableTd" align="right">
					<xsl:text>&#160;</xsl:text>
				</td>
				<td id="lineTableTd" align="right">
					<xsl:text>&#160;</xsl:text>
				</td>
				<td id="lineTableTd" align="right">
					<xsl:text>&#160;</xsl:text>
				</td>
				<td id="lineTableTd" align="right">
					<xsl:text>&#160;</xsl:text>
				</td>
				<td id="lineTableTd" align="right">
					<xsl:text>&#160;</xsl:text>
				</td>
			</xsl:if>
		</tr>
	</xsl:template>
	<xsl:template name="Party_Title">
		<xsl:param name="PartyType"/>
		<td style="width:469px; " align="left">
			<xsl:if test="cac:PartyName">
				<xsl:value-of select="cac:PartyName/cbc:Name"/>
				<br/>
			</xsl:if>
			<xsl:for-each select="cac:Person">
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
					<xsl:for-each select="cbc:NationalityID">
						<xsl:call-template name="Country">
							<xsl:with-param name="CountryType">
								<xsl:value-of select="."/>
							</xsl:with-param>
						</xsl:call-template>
					</xsl:for-each>
				</xsl:if>
			</xsl:for-each>
		</td>
	</xsl:template>
	<xsl:template name="Party_Adress">
		<xsl:param name="PartyType"/>
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
				<xsl:if test="$PartyType!='OTHER'">
					<br/>
					<xsl:value-of select="cac:Country/cbc:Name"/>
					<br/>
				</xsl:if>
			</xsl:for-each>
		</td>
	</xsl:template>
	<xsl:template name="TransportMode">
		<xsl:param name="TransportModeType"/>
		<xsl:choose>
			<xsl:when test="$TransportModeType=1">Denizyolu</xsl:when>
			<xsl:when test="$TransportModeType=2">Demiryolu</xsl:when>
			<xsl:when test="$TransportModeType=3">Karayolu</xsl:when>
			<xsl:when test="$TransportModeType=4">Havayolu</xsl:when>
			<xsl:when test="$TransportModeType=5">Posta</xsl:when>
			<xsl:when test="$TransportModeType=6">Çok araçlı</xsl:when>
			<xsl:when test="$TransportModeType=7">Sabit taşıma tesisleri</xsl:when>
			<xsl:when test="$TransportModeType=8">İç su taşımacılığı</xsl:when>
			<xsl:otherwise>
				<xsl:value-of select="$TransportModeType"/>
			</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	<xsl:template name="Packaging">
		<xsl:param name="PackagingType"/>
		<xsl:choose>
			<xsl:when test="$PackagingType='1A'">Drum, steel</xsl:when>
			<xsl:when test="$PackagingType='1B'">Drum, aluminium</xsl:when>
			<xsl:when test="$PackagingType='1D'">Drum, plywood</xsl:when>
			<xsl:when test="$PackagingType='1F'">Container, flexible</xsl:when>
			<xsl:when test="$PackagingType='1G'">Drum, fibre</xsl:when>
			<xsl:when test="$PackagingType='1W'">Drum, wooden</xsl:when>
			<xsl:when test="$PackagingType='2C'">Barrel, wooden</xsl:when>
			<xsl:when test="$PackagingType='3A'">Jerrican, steel</xsl:when>
			<xsl:when test="$PackagingType='3H'">Jerrican, plastic</xsl:when>
			<xsl:when test="$PackagingType='43'">Bag, super bulk</xsl:when>
			<xsl:when test="$PackagingType='44'">Bag, polybag</xsl:when>
			<xsl:when test="$PackagingType='4A'">Box, steel</xsl:when>
			<xsl:when test="$PackagingType='4B'">Box, aluminium</xsl:when>
			<xsl:when test="$PackagingType='4C'">Box, natural wood</xsl:when>
			<xsl:when test="$PackagingType='4D'">Box, plywood</xsl:when>
			<xsl:when test="$PackagingType='4F'">Box, reconstituted wood</xsl:when>
			<xsl:when test="$PackagingType='4G'">Box, fibreboard</xsl:when>
			<xsl:when test="$PackagingType='4H'">Box, plastic</xsl:when>
			<xsl:when test="$PackagingType='5H'">Bag, woven plastic</xsl:when>
			<xsl:when test="$PackagingType='5L'">Bag, textile</xsl:when>
			<xsl:when test="$PackagingType='5M'">Bag, paper</xsl:when>
			<xsl:when test="$PackagingType='6H'">Composite packaging, plastic receptacle</xsl:when>
			<xsl:when test="$PackagingType='6P'">Composite packaging, glass receptacle</xsl:when>
			<xsl:when test="$PackagingType='7A'">Case, car</xsl:when>
			<xsl:when test="$PackagingType='7B'">Case, wooden</xsl:when>
			<xsl:when test="$PackagingType='8A'">Pallet, wooden</xsl:when>
			<xsl:when test="$PackagingType='8B'">Crate, wooden</xsl:when>
			<xsl:when test="$PackagingType='8C'">Bundle, wooden</xsl:when>
			<xsl:when test="$PackagingType='AA'">Intermediate bulk container, rigid plastic</xsl:when>
			<xsl:when test="$PackagingType='AB'">Receptacle, fibre</xsl:when>
			<xsl:when test="$PackagingType='AC'">Receptacle, paper</xsl:when>
			<xsl:when test="$PackagingType='AD'">Receptacle, wooden</xsl:when>
			<xsl:when test="$PackagingType='AE'">Aerosol</xsl:when>
			<xsl:when test="$PackagingType='AF'">Pallet, modular, collars 80cms * 60cms</xsl:when>
			<xsl:when test="$PackagingType='AG'">Pallet, shrinkwrapped</xsl:when>
			<xsl:when test="$PackagingType='AH'">Pallet, 100cms * 110cms</xsl:when>
			<xsl:when test="$PackagingType='AI'">Clamshell</xsl:when>
			<xsl:when test="$PackagingType='AJ'">Cone</xsl:when>
			<xsl:when test="$PackagingType='AL'">Ball</xsl:when>
			<xsl:when test="$PackagingType='AM'">Ampoule, non-protected</xsl:when>
			<xsl:when test="$PackagingType='AP'">Ampoule, protected</xsl:when>
			<xsl:when test="$PackagingType='AT'">Atomizer</xsl:when>
			<xsl:when test="$PackagingType='AV'">Capsule</xsl:when>
			<xsl:when test="$PackagingType='B4'">Belt</xsl:when>
			<xsl:when test="$PackagingType='BA'">Barrel</xsl:when>
			<xsl:when test="$PackagingType='BB'">Bobbin</xsl:when>
			<xsl:when test="$PackagingType='BC'">Bottlecrate / bottlerack</xsl:when>
			<xsl:when test="$PackagingType='BD'">Board</xsl:when>
			<xsl:when test="$PackagingType='BE'">Bundle</xsl:when>
			<xsl:when test="$PackagingType='BF'">Balloon, non-protected</xsl:when>
			<xsl:when test="$PackagingType='BG'">Bag</xsl:when>
			<xsl:when test="$PackagingType='BH'">Bunch</xsl:when>
			<xsl:when test="$PackagingType='BI'">Bin</xsl:when>
			<xsl:when test="$PackagingType='BJ'">Bucket</xsl:when>
			<xsl:when test="$PackagingType='BK'">Basket</xsl:when>
			<xsl:when test="$PackagingType='BL'">Bale, compressed</xsl:when>
			<xsl:when test="$PackagingType='BM'">Basin</xsl:when>
			<xsl:when test="$PackagingType='BN'">Bale, non-compressed</xsl:when>
			<xsl:when test="$PackagingType='BO'">Bottle, non-protected, cylindrical</xsl:when>
			<xsl:when test="$PackagingType='BP'">Balloon, protected</xsl:when>
			<xsl:when test="$PackagingType='BQ'">Bottle, protected cylindrical</xsl:when>
			<xsl:when test="$PackagingType='BR'">Bar</xsl:when>
			<xsl:when test="$PackagingType='BS'">Bottle, non-protected, bulbous</xsl:when>
			<xsl:when test="$PackagingType='BT'">Bolt</xsl:when>
			<xsl:when test="$PackagingType='BU'">Butt</xsl:when>
			<xsl:when test="$PackagingType='BV'">Bottle, protected bulbous</xsl:when>
			<xsl:when test="$PackagingType='BW'">Box, for liquids</xsl:when>
			<xsl:when test="$PackagingType='BX'">Box</xsl:when>
			<xsl:when test="$PackagingType='BY'">Board, in bundle/bunch/truss</xsl:when>
			<xsl:when test="$PackagingType='BZ'">Bars, in bundle/bunch/truss</xsl:when>
			<xsl:when test="$PackagingType='CA'">Can, rectangular</xsl:when>
			<xsl:when test="$PackagingType='CB'">Crate, beer</xsl:when>
			<xsl:when test="$PackagingType='CC'">Churn</xsl:when>
			<xsl:when test="$PackagingType='CD'">Can, with handle and spout</xsl:when>
			<xsl:when test="$PackagingType='CE'">Creel</xsl:when>
			<xsl:when test="$PackagingType='CF'">Coffer</xsl:when>
			<xsl:when test="$PackagingType='CG'">Cage</xsl:when>
			<xsl:when test="$PackagingType='CH'">Chest</xsl:when>
			<xsl:when test="$PackagingType='CI'">Canister</xsl:when>
			<xsl:when test="$PackagingType='CJ'">Coffin</xsl:when>
			<xsl:when test="$PackagingType='CK'">Cask</xsl:when>
			<xsl:when test="$PackagingType='CL'">Coil</xsl:when>
			<xsl:when test="$PackagingType='CM'">Card</xsl:when>
			<xsl:when test="$PackagingType='CN'">Container, not otherwise specified as transport equipment</xsl:when>
			<xsl:when test="$PackagingType='CO'">Carboy, non-protected</xsl:when>
			<xsl:when test="$PackagingType='CP'">Carboy, protected</xsl:when>
			<xsl:when test="$PackagingType='CQ'">Cartridge</xsl:when>
			<xsl:when test="$PackagingType='CR'">Crate</xsl:when>
			<xsl:when test="$PackagingType='CS'">Case</xsl:when>
			<xsl:when test="$PackagingType='CT'">Carton</xsl:when>
			<xsl:when test="$PackagingType='CU'">Cup</xsl:when>
			<xsl:when test="$PackagingType='CV'">Cover</xsl:when>
			<xsl:when test="$PackagingType='CW'">Cage, roll</xsl:when>
			<xsl:when test="$PackagingType='CX'">Can, cylindrical</xsl:when>
			<xsl:when test="$PackagingType='CY'">Cylinder</xsl:when>
			<xsl:when test="$PackagingType='CZ'">Canvas</xsl:when>
			<xsl:when test="$PackagingType='DA'">Crate, multiple layer, plastic</xsl:when>
			<xsl:when test="$PackagingType='DB'">Crate, multiple layer, wooden</xsl:when>
			<xsl:when test="$PackagingType='DC'">Crate, multiple layer, cardboard</xsl:when>
			<xsl:when test="$PackagingType='DG'">Cage, Commonwealth Handling Equipment Pool (CHEP)</xsl:when>
			<xsl:when test="$PackagingType='DH'">Box, Commonwealth Handling Equipment Pool (CHEP), Eurobox</xsl:when>
			<xsl:when test="$PackagingType='DI'">Drum, iron</xsl:when>
			<xsl:when test="$PackagingType='DJ'">Demijohn, non-protected</xsl:when>
			<xsl:when test="$PackagingType='DK'">Crate, bulk, cardboard</xsl:when>
			<xsl:when test="$PackagingType='DL'">Crate, bulk, plastic</xsl:when>
			<xsl:when test="$PackagingType='DM'">Crate, bulk, wooden</xsl:when>
			<xsl:when test="$PackagingType='DN'">Dispenser</xsl:when>
			<xsl:when test="$PackagingType='DP'">Demijohn, protected</xsl:when>
			<xsl:when test="$PackagingType='DR'">Drum</xsl:when>
			<xsl:when test="$PackagingType='DS'">Tray, one layer no cover, plastic</xsl:when>
			<xsl:when test="$PackagingType='DT'">Tray, one layer no cover, wooden</xsl:when>
			<xsl:when test="$PackagingType='DU'">Tray, one layer no cover, polystyrene</xsl:when>
			<xsl:when test="$PackagingType='DV'">Tray, one layer no cover, cardboard</xsl:when>
			<xsl:when test="$PackagingType='DW'">Tray, two layers no cover, plastic tray</xsl:when>
			<xsl:when test="$PackagingType='DX'">Tray, two layers no cover, wooden</xsl:when>
			<xsl:when test="$PackagingType='DY'">Tray, two layers no cover, cardboard</xsl:when>
			<xsl:when test="$PackagingType='EC'">Bag, plastic</xsl:when>
			<xsl:when test="$PackagingType='ED'">Case, with pallet base</xsl:when>
			<xsl:when test="$PackagingType='EE'">Case, with pallet base, wooden</xsl:when>
			<xsl:when test="$PackagingType='EF'">Case, with pallet base, cardboard</xsl:when>
			<xsl:when test="$PackagingType='EG'">Case, with pallet base, plastic</xsl:when>
			<xsl:when test="$PackagingType='EH'">Case, with pallet base, metal</xsl:when>
			<xsl:when test="$PackagingType='EI'">Case, isothermic</xsl:when>
			<xsl:when test="$PackagingType='EN'">Envelope</xsl:when>
			<xsl:when test="$PackagingType='FB'">Flexibag</xsl:when>
			<xsl:when test="$PackagingType='FC'">Crate, fruit</xsl:when>
			<xsl:when test="$PackagingType='FD'">Crate, framed</xsl:when>
			<xsl:when test="$PackagingType='FE'">Flexitank</xsl:when>
			<xsl:when test="$PackagingType='FI'">Firkin</xsl:when>
			<xsl:when test="$PackagingType='FL'">Flask</xsl:when>
			<xsl:when test="$PackagingType='FO'">Footlocker</xsl:when>
			<xsl:when test="$PackagingType='FP'">Filmpack</xsl:when>
			<xsl:when test="$PackagingType='FR'">Frame</xsl:when>
			<xsl:when test="$PackagingType='FT'">Foodtainer</xsl:when>
			<xsl:when test="$PackagingType='FW'">Cart, flatbed</xsl:when>
			<xsl:when test="$PackagingType='FX'">Bag, flexible container</xsl:when>
			<xsl:when test="$PackagingType='GB'">Bottle, gas</xsl:when>
			<xsl:when test="$PackagingType='GI'">Girder</xsl:when>
			<xsl:when test="$PackagingType='GL'">Container, gallon</xsl:when>
			<xsl:when test="$PackagingType='GR'">Receptacle, glass</xsl:when>
			<xsl:when test="$PackagingType='GU'">Tray, containing horizontally stacked flat items</xsl:when>
			<xsl:when test="$PackagingType='GY'">Bag, gunny</xsl:when>
			<xsl:when test="$PackagingType='GZ'">Girders, in bundle/bunch/truss</xsl:when>
			<xsl:when test="$PackagingType='HA'">Basket, with handle, plastic</xsl:when>
			<xsl:when test="$PackagingType='HB'">Basket, with handle, wooden</xsl:when>
			<xsl:when test="$PackagingType='HC'">Basket, with handle, cardboard</xsl:when>
			<xsl:when test="$PackagingType='HG'">Hogshead</xsl:when>
			<xsl:when test="$PackagingType='HN'">Hanger</xsl:when>
			<xsl:when test="$PackagingType='HR'">Hamper</xsl:when>
			<xsl:when test="$PackagingType='IA'">Package, display, wooden</xsl:when>
			<xsl:when test="$PackagingType='IB'">Package, display, cardboard</xsl:when>
			<xsl:when test="$PackagingType='IC'">Package, display, plastic</xsl:when>
			<xsl:when test="$PackagingType='ID'">Package, display, metal</xsl:when>
			<xsl:when test="$PackagingType='IE'">Package, show</xsl:when>
			<xsl:when test="$PackagingType='IF'">Package, flow</xsl:when>
			<xsl:when test="$PackagingType='IG'">Package, paper wrapped</xsl:when>
			<xsl:when test="$PackagingType='IH'">Drum, plastic</xsl:when>
			<xsl:when test="$PackagingType='IK'">Package, cardboard, with bottle grip-holes</xsl:when>
			<xsl:when test="$PackagingType='IL'">Tray, rigid, lidded stackable (CEN TS 14482:2002)</xsl:when>
			<xsl:when test="$PackagingType='IN'">Ingot</xsl:when>
			<xsl:when test="$PackagingType='IZ'">Ingots, in bundle/bunch/truss</xsl:when>
			<xsl:when test="$PackagingType='JB'">Bag, jumbo</xsl:when>
			<xsl:when test="$PackagingType='JC'">Jerrican, rectangular</xsl:when>
			<xsl:when test="$PackagingType='JG'">Jug</xsl:when>
			<xsl:when test="$PackagingType='JR'">Jar</xsl:when>
			<xsl:when test="$PackagingType='JT'">Jutebag</xsl:when>
			<xsl:when test="$PackagingType='JY'">Jerrican, cylindrical</xsl:when>
			<xsl:when test="$PackagingType='KG'">Keg</xsl:when>
			<xsl:when test="$PackagingType='KI'">Kit</xsl:when>
			<xsl:when test="$PackagingType='LE'">Luggage</xsl:when>
			<xsl:when test="$PackagingType='LG'">Log</xsl:when>
			<xsl:when test="$PackagingType='LT'">Lot</xsl:when>
			<xsl:when test="$PackagingType='LU'">Lug</xsl:when>
			<xsl:when test="$PackagingType='LV'">Liftvan</xsl:when>
			<xsl:when test="$PackagingType='LZ'">Logs, in bundle/bunch/truss</xsl:when>
			<xsl:when test="$PackagingType='MA'">Crate, metal</xsl:when>
			<xsl:when test="$PackagingType='MB'">Bag, multiply</xsl:when>
			<xsl:when test="$PackagingType='MC'">Crate, milk</xsl:when>
			<xsl:when test="$PackagingType='ME'">Container, metal</xsl:when>
			<xsl:when test="$PackagingType='MR'">Receptacle, metal</xsl:when>
			<xsl:when test="$PackagingType='MS'">Sack, multi-wall</xsl:when>
			<xsl:when test="$PackagingType='MT'">Mat</xsl:when>
			<xsl:when test="$PackagingType='MW'">Receptacle, plastic wrapped</xsl:when>
			<xsl:when test="$PackagingType='MX'">Matchbox</xsl:when>
			<xsl:when test="$PackagingType='NA'">Not available</xsl:when>
			<xsl:when test="$PackagingType='NE'">Unpacked or unpackaged</xsl:when>
			<xsl:when test="$PackagingType='NF'">Unpacked or unpackaged, single unit</xsl:when>
			<xsl:when test="$PackagingType='NG'">Unpacked or unpackaged, multiple units</xsl:when>
			<xsl:when test="$PackagingType='NS'">Nest</xsl:when>
			<xsl:when test="$PackagingType='NT'">Net</xsl:when>
			<xsl:when test="$PackagingType='NU'">Net, tube, plastic</xsl:when>
			<xsl:when test="$PackagingType='NV'">Net, tube, textile</xsl:when>
			<xsl:when test="$PackagingType='OA'">Pallet, CHEP 40 cm x 60 cm</xsl:when>
			<xsl:when test="$PackagingType='OB'">Pallet, CHEP 80 cm x 120 cm</xsl:when>
			<xsl:when test="$PackagingType='OC'">Pallet, CHEP 100 cm x 120 cm</xsl:when>
			<xsl:when test="$PackagingType='OD'">Pallet, AS 4068-1993</xsl:when>
			<xsl:when test="$PackagingType='OE'">Pallet, ISO T11</xsl:when>
			<xsl:when test="$PackagingType='OF'">Platform, unspecified weight or dimension</xsl:when>
			<xsl:when test="$PackagingType='OK'">Block</xsl:when>
			<xsl:when test="$PackagingType='OT'">Octabin</xsl:when>
			<xsl:when test="$PackagingType='OU'">Container, outer</xsl:when>
			<xsl:when test="$PackagingType='P2'">Pan</xsl:when>
			<xsl:when test="$PackagingType='PA'">Packet</xsl:when>
			<xsl:when test="$PackagingType='PB'">Pallet, box Combined open-ended box and pallet</xsl:when>
			<xsl:when test="$PackagingType='PC'">Parcel</xsl:when>
			<xsl:when test="$PackagingType='PD'">Pallet, modular, collars 80cms * 100cms</xsl:when>
			<xsl:when test="$PackagingType='PE'">Pallet, modular, collars 80cms * 120cms</xsl:when>
			<xsl:when test="$PackagingType='PF'">Pen</xsl:when>
			<xsl:when test="$PackagingType='PG'">Plate</xsl:when>
			<xsl:when test="$PackagingType='PH'">Pitcher</xsl:when>
			<xsl:when test="$PackagingType='PI'">Pipe</xsl:when>
			<xsl:when test="$PackagingType='PJ'">Punnet</xsl:when>
			<xsl:when test="$PackagingType='PK'">Package</xsl:when>
			<xsl:when test="$PackagingType='PL'">Pail</xsl:when>
			<xsl:when test="$PackagingType='PN'">Plank</xsl:when>
			<xsl:when test="$PackagingType='PO'">Pouch</xsl:when>
			<xsl:when test="$PackagingType='PP'">Piece</xsl:when>
			<xsl:when test="$PackagingType='PR'">Receptacle, plastic</xsl:when>
			<xsl:when test="$PackagingType='PT'">Pot</xsl:when>
			<xsl:when test="$PackagingType='PU'">Tray</xsl:when>
			<xsl:when test="$PackagingType='PV'">Pipes, in bundle/bunch/truss</xsl:when>
			<xsl:when test="$PackagingType='PX'">Pallet</xsl:when>
			<xsl:when test="$PackagingType='PY'">Plates, in bundle/bunch/truss</xsl:when>
			<xsl:when test="$PackagingType='PZ'">Planks, in bundle/bunch/truss</xsl:when>
			<xsl:when test="$PackagingType='QA'">Drum, steel, non-removable head</xsl:when>
			<xsl:when test="$PackagingType='QB'">Drum, steel, removable head</xsl:when>
			<xsl:when test="$PackagingType='QC'">Drum, aluminium, non-removable head</xsl:when>
			<xsl:when test="$PackagingType='QD'">Drum, aluminium, removable head</xsl:when>
			<xsl:when test="$PackagingType='QF'">Drum, plastic, non-removable head</xsl:when>
			<xsl:when test="$PackagingType='QG'">Drum, plastic, removable head</xsl:when>
			<xsl:when test="$PackagingType='QH'">Barrel, wooden, bung type</xsl:when>
			<xsl:when test="$PackagingType='QJ'">Barrel, wooden, removable head</xsl:when>
			<xsl:when test="$PackagingType='QK'">Jerrican, steel, non-removable head</xsl:when>
			<xsl:when test="$PackagingType='QL'">Jerrican, steel, removable head</xsl:when>
			<xsl:when test="$PackagingType='QM'">Jerrican, plastic, non-removable head</xsl:when>
			<xsl:when test="$PackagingType='QN'">Jerrican, plastic, removable head</xsl:when>
			<xsl:when test="$PackagingType='QP'">Box, wooden, natural wood, ordinary</xsl:when>
			<xsl:when test="$PackagingType='QQ'">Box, wooden, natural wood, with sift proof walls</xsl:when>
			<xsl:when test="$PackagingType='QR'">Box, plastic, expanded</xsl:when>
			<xsl:when test="$PackagingType='QS'">Box, plastic, solid</xsl:when>
			<xsl:when test="$PackagingType='RD'">Rod</xsl:when>
			<xsl:when test="$PackagingType='RG'">Ring</xsl:when>
			<xsl:when test="$PackagingType='RJ'">Rack, clothing hanger</xsl:when>
			<xsl:when test="$PackagingType='RK'">Rack</xsl:when>
			<xsl:when test="$PackagingType='RL'">Reel</xsl:when>
			<xsl:when test="$PackagingType='RO'">Roll</xsl:when>
			<xsl:when test="$PackagingType='RT'">Rednet</xsl:when>
			<xsl:when test="$PackagingType='RZ'">Rods, in bundle/bunch/truss</xsl:when>
			<xsl:when test="$PackagingType='SA'">Sack</xsl:when>
			<xsl:when test="$PackagingType='SB'">Slab</xsl:when>
			<xsl:when test="$PackagingType='SC'">Crate, shallow</xsl:when>
			<xsl:when test="$PackagingType='SD'">Spindle</xsl:when>
			<xsl:when test="$PackagingType='SE'">Sea-chest</xsl:when>
			<xsl:when test="$PackagingType='SH'">Sachet</xsl:when>
			<xsl:when test="$PackagingType='SI'">Skid</xsl:when>
			<xsl:when test="$PackagingType='SK'">Case, skeleton</xsl:when>
			<xsl:when test="$PackagingType='SL'">Slipsheet</xsl:when>
			<xsl:when test="$PackagingType='SM'">Sheetmetal</xsl:when>
			<xsl:when test="$PackagingType='SO'">Spool</xsl:when>
			<xsl:when test="$PackagingType='SP'">Sheet, plastic wrapping</xsl:when>
			<xsl:when test="$PackagingType='SS'">Case, steel</xsl:when>
			<xsl:when test="$PackagingType='ST'">Sheet</xsl:when>
			<xsl:when test="$PackagingType='SU'">Suitcase</xsl:when>
			<xsl:when test="$PackagingType='SV'">Envelope, steel</xsl:when>
			<xsl:when test="$PackagingType='SW'">Shrinkwrapped</xsl:when>
			<xsl:when test="$PackagingType='SX'">Set</xsl:when>
			<xsl:when test="$PackagingType='SY'">Sleeve</xsl:when>
			<xsl:when test="$PackagingType='SZ'">Sheets, in bundle/bunch/truss</xsl:when>
			<xsl:when test="$PackagingType='T1'">Tablet</xsl:when>
			<xsl:when test="$PackagingType='TB'">Tub</xsl:when>
			<xsl:when test="$PackagingType='TC'">Tea-chest</xsl:when>
			<xsl:when test="$PackagingType='TD'">Tube, collapsible</xsl:when>
			<xsl:when test="$PackagingType='TE'">Tyre</xsl:when>
			<xsl:when test="$PackagingType='TG'">Tank container, generic</xsl:when>
			<xsl:when test="$PackagingType='TI'">Tierce</xsl:when>
			<xsl:when test="$PackagingType='TK'">Tank, rectangular</xsl:when>
			<xsl:when test="$PackagingType='TL'">Tub, with lid</xsl:when>
			<xsl:when test="$PackagingType='TN'">Tin</xsl:when>
			<xsl:when test="$PackagingType='TO'">Tun</xsl:when>
			<xsl:when test="$PackagingType='TR'">Trunk</xsl:when>
			<xsl:when test="$PackagingType='TS'">Truss</xsl:when>
			<xsl:when test="$PackagingType='TT'">Bag, tote</xsl:when>
			<xsl:when test="$PackagingType='TU'">Tube</xsl:when>
			<xsl:when test="$PackagingType='TV'">Tube, with nozzle</xsl:when>
			<xsl:when test="$PackagingType='TW'">Pallet, triwall</xsl:when>
			<xsl:when test="$PackagingType='TY'">Tank, cylindrical</xsl:when>
			<xsl:when test="$PackagingType='TZ'">Tubes, in bundle/bunch/truss</xsl:when>
			<xsl:when test="$PackagingType='UC'">Uncaged</xsl:when>
			<xsl:when test="$PackagingType='UN'">Unit</xsl:when>
			<xsl:when test="$PackagingType='VA'">Vat</xsl:when>
			<xsl:when test="$PackagingType='VG'">Bulk, gas (at 1031 mbar and 15Â°C)</xsl:when>
			<xsl:when test="$PackagingType='VI'">Vial</xsl:when>
			<xsl:when test="$PackagingType='VK'">Vanpack</xsl:when>
			<xsl:when test="$PackagingType='VL'">Bulk, liquid</xsl:when>
			<xsl:when test="$PackagingType='VO'">Bulk, solid, large particles (Â“nodulesÂ”)</xsl:when>
			<xsl:when test="$PackagingType='VP'">Vacuum-packed</xsl:when>
			<xsl:when test="$PackagingType='VQ'">Bulk, liquefied gas (at abnormal temperature/pressure)</xsl:when>
			<xsl:when test="$PackagingType='VN'">Vehicle</xsl:when>
			<xsl:when test="$PackagingType='VR'">Bulk, solid, granular particles (Â“grainsÂ”)</xsl:when>
			<xsl:when test="$PackagingType='VS'">Bulk, scrap metal</xsl:when>
			<xsl:when test="$PackagingType='VY'">Bulk, solid, fine particles (Â“powdersÂ”)</xsl:when>
			<xsl:when test="$PackagingType='WA'">Intermediate bulk container</xsl:when>
			<xsl:when test="$PackagingType='WB'">Wickerbottle</xsl:when>
			<xsl:when test="$PackagingType='WC'">Intermediate bulk container, steel</xsl:when>
			<xsl:when test="$PackagingType='WD'">Intermediate bulk container, aluminium</xsl:when>
			<xsl:when test="$PackagingType='WF'">Intermediate bulk container, metal</xsl:when>
			<xsl:when test="$PackagingType='WG'">Intermediate bulk container, steel, pressurised > 10 kpa</xsl:when>
			<xsl:when test="$PackagingType='WH'">Intermediate bulk container, aluminium, pressurised > 10 kpa</xsl:when>
			<xsl:when test="$PackagingType='WJ'">Intermediate bulk container, metal, pressure 10 kpa</xsl:when>
			<xsl:when test="$PackagingType='WK'">Intermediate bulk container, steel, liquid</xsl:when>
			<xsl:when test="$PackagingType='WL'">Intermediate bulk container, aluminium, liquid</xsl:when>
			<xsl:when test="$PackagingType='WM'">Intermediate bulk container, metal, liquid</xsl:when>
			<xsl:when test="$PackagingType='WN'">Intermediate bulk container, woven plastic, without coat/liner</xsl:when>
			<xsl:when test="$PackagingType='WP'">Intermediate bulk container, woven plastic, coated</xsl:when>
			<xsl:when test="$PackagingType='WQ'">Intermediate bulk container, woven plastic, with liner</xsl:when>
			<xsl:when test="$PackagingType='WR'">Intermediate bulk container, woven plastic, coated and liner</xsl:when>
			<xsl:when test="$PackagingType='WS'">Intermediate bulk container, plastic film</xsl:when>
			<xsl:when test="$PackagingType='WT'">Intermediate bulk container, textile with out coat/liner</xsl:when>
			<xsl:when test="$PackagingType='WU'">Intermediate bulk container, natural wood, with inner liner</xsl:when>
			<xsl:when test="$PackagingType='WV'">Intermediate bulk container, textile, coated</xsl:when>
			<xsl:when test="$PackagingType='WW'">Intermediate bulk container, textile, with liner</xsl:when>
			<xsl:when test="$PackagingType='WX'">Intermediate bulk container, textile, coated and liner</xsl:when>
			<xsl:when test="$PackagingType='WY'">Intermediate bulk container, plywood, with inner liner</xsl:when>
			<xsl:when test="$PackagingType='WZ'">Intermediate bulk container, reconstituted wood, with inner liner</xsl:when>
			<xsl:when test="$PackagingType='XA'">Bag, woven plastic, without inner coat/liner</xsl:when>
			<xsl:when test="$PackagingType='XB'">Bag, woven plastic, sift proof</xsl:when>
			<xsl:when test="$PackagingType='XC'">Bag, woven plastic, water resistant</xsl:when>
			<xsl:when test="$PackagingType='XD'">Bag, plastics film</xsl:when>
			<xsl:when test="$PackagingType='XF'">Bag, textile, without inner coat/liner</xsl:when>
			<xsl:when test="$PackagingType='XG'">Bag, textile, sift proof</xsl:when>
			<xsl:when test="$PackagingType='XH'">Bag, textile, water resistant</xsl:when>
			<xsl:when test="$PackagingType='XJ'">Bag, paper, multi-wall</xsl:when>
			<xsl:when test="$PackagingType='XK'">Bag, paper, multi-wall, water resistant</xsl:when>
			<xsl:when test="$PackagingType='YA'">Composite packaging, plastic receptacle in steel drum</xsl:when>
			<xsl:when test="$PackagingType='YB'">Composite packaging, plastic receptacle in steel crate box</xsl:when>
			<xsl:when test="$PackagingType='YC'">Composite packaging, plastic receptacle in aluminium drum</xsl:when>
			<xsl:when test="$PackagingType='YD'">Composite packaging, plastic receptacle in aluminium crate</xsl:when>
			<xsl:when test="$PackagingType='YF'">Composite packaging, plastic receptacle in wooden box</xsl:when>
			<xsl:when test="$PackagingType='YG'">Composite packaging, plastic receptacle in plywood drum</xsl:when>
			<xsl:when test="$PackagingType='YH'">Composite packaging, plastic receptacle in plywood box</xsl:when>
			<xsl:when test="$PackagingType='YJ'">Composite packaging, plastic receptacle in fibre drum</xsl:when>
			<xsl:when test="$PackagingType='YK'">Composite packaging, plastic receptacle in fibreboard box</xsl:when>
			<xsl:when test="$PackagingType='YL'">Composite packaging, plastic receptacle in plastic drum</xsl:when>
			<xsl:when test="$PackagingType='YM'">Composite packaging, plastic receptacle in solid plastic box</xsl:when>
			<xsl:when test="$PackagingType='YN'">Composite packaging, glass receptacle in steel drum</xsl:when>
			<xsl:when test="$PackagingType='YP'">Composite packaging, glass receptacle in steel crate box</xsl:when>
			<xsl:when test="$PackagingType='YQ'">Composite packaging, glass receptacle in aluminium drum</xsl:when>
			<xsl:when test="$PackagingType='YR'">Composite packaging, glass receptacle in aluminium crate</xsl:when>
			<xsl:when test="$PackagingType='YS'">Composite packaging, glass receptacle in wooden box</xsl:when>
			<xsl:when test="$PackagingType='YT'">Composite packaging, glass receptacle in plywood drum</xsl:when>
			<xsl:when test="$PackagingType='YV'">Composite packaging, glass receptacle in wickerwork hamper</xsl:when>
			<xsl:when test="$PackagingType='YW'">Composite packaging, glass receptacle in fibre drum</xsl:when>
			<xsl:when test="$PackagingType='YX'">Composite packaging, glass receptacle in fibreboard box</xsl:when>
			<xsl:when test="$PackagingType='YY'">Composite packaging, glass receptacle in expandable plastic pack</xsl:when>
			<xsl:when test="$PackagingType='YZ'">Composite packaging, glass receptacle in solid plastic pack</xsl:when>
			<xsl:when test="$PackagingType='ZA'">Intermediate bulk container, paper, multi-wall</xsl:when>
			<xsl:when test="$PackagingType='ZB'">Bag, large</xsl:when>
			<xsl:when test="$PackagingType='ZC'">Intermediate bulk container, paper, multi-wall, water resistant</xsl:when>
			<xsl:when test="$PackagingType='ZD'">Intermediate bulk container, rigid plastic, with structural equipment, solids</xsl:when>
			<xsl:when test="$PackagingType='ZF'">Intermediate bulk container, rigid plastic, freestanding, solids</xsl:when>
			<xsl:when test="$PackagingType='ZG'">Intermediate bulk container, rigid plastic, with structural equipment, pressurised</xsl:when>
			<xsl:when test="$PackagingType='ZH'">Intermediate bulk container, rigid plastic, freestanding, pressurised</xsl:when>
			<xsl:when test="$PackagingType='ZJ'">Intermediate bulk container, rigid plastic, with structural equipment, liquids</xsl:when>
			<xsl:when test="$PackagingType='ZK'">Intermediate bulk container, rigid plastic, freestanding, liquids</xsl:when>
			<xsl:when test="$PackagingType='ZL'">Intermediate bulk container, composite, rigid plastic, solids</xsl:when>
			<xsl:when test="$PackagingType='ZM'">Intermediate bulk container, composite, flexible plastic, solids</xsl:when>
			<xsl:when test="$PackagingType='ZN'">Intermediate bulk container, composite, rigid plastic, pressurised</xsl:when>
			<xsl:when test="$PackagingType='ZP'">Intermediate bulk container, composite, flexible plastic, pressurised</xsl:when>
			<xsl:when test="$PackagingType='ZQ'">Intermediate bulk container, composite, rigid plastic, liquids</xsl:when>
			<xsl:when test="$PackagingType='ZR'">Intermediate bulk container, composite, flexible plastic, liquids</xsl:when>
			<xsl:when test="$PackagingType='ZS'">Intermediate bulk container, composite</xsl:when>
			<xsl:when test="$PackagingType='ZT'">Intermediate bulk container, fibreboard</xsl:when>
			<xsl:when test="$PackagingType='ZU'">Intermediate bulk container, flexible</xsl:when>
			<xsl:when test="$PackagingType='ZV'">Intermediate bulk container, metal, other than steel</xsl:when>
			<xsl:when test="$PackagingType='ZW'">Intermediate bulk container, natural wood</xsl:when>
			<xsl:when test="$PackagingType='ZX'">Intermediate bulk container, plywood</xsl:when>
			<xsl:when test="$PackagingType='ZY'">Intermediate bulk container, reconstituted wood</xsl:when>
			<xsl:otherwise>
				<xsl:value-of select="$PackagingType"/>
			</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	<xsl:template name="Country">
		<xsl:param name="CountryType"/>
		<xsl:choose>
			<xsl:when test="$CountryType='AF'">Afganistan</xsl:when>
			<xsl:when test="$CountryType='DE'">Almanya</xsl:when>
			<xsl:when test="$CountryType='AD'">Andorra</xsl:when>
			<xsl:when test="$CountryType='AO'">Angola</xsl:when>
			<xsl:when test="$CountryType='AG'">Antigua ve Barbuda</xsl:when>
			<xsl:when test="$CountryType='AR'">Arjantin</xsl:when>
			<xsl:when test="$CountryType='AL'">Arnavutluk</xsl:when>
			<xsl:when test="$CountryType='AW'">Aruba</xsl:when>
			<xsl:when test="$CountryType='AU'">Avustralya</xsl:when>
			<xsl:when test="$CountryType='AT'">Avusturya</xsl:when>
			<xsl:when test="$CountryType='AZ'">Azerbaycan</xsl:when>
			<xsl:when test="$CountryType='BS'">Bahamalar</xsl:when>
			<xsl:when test="$CountryType='BH'">Bahreyn</xsl:when>
			<xsl:when test="$CountryType='BD'">Bangladeş</xsl:when>
			<xsl:when test="$CountryType='BB'">Barbados</xsl:when>
			<xsl:when test="$CountryType='EH'">Batı Sahra (MA)</xsl:when>
			<xsl:when test="$CountryType='BE'">Belçika</xsl:when>
			<xsl:when test="$CountryType='BZ'">Belize</xsl:when>
			<xsl:when test="$CountryType='BJ'">Benin</xsl:when>
			<xsl:when test="$CountryType='BM'">Bermuda</xsl:when>
			<xsl:when test="$CountryType='BY'">Beyaz Rusya</xsl:when>
			<xsl:when test="$CountryType='BT'">Bhutan</xsl:when>
			<xsl:when test="$CountryType='AE'">Birleşik Arap Emirlikleri</xsl:when>
			<xsl:when test="$CountryType='US'">Birleşik Devletler</xsl:when>
			<xsl:when test="$CountryType='GB'">Birleşik Krallık</xsl:when>
			<xsl:when test="$CountryType='BO'">Bolivya</xsl:when>
			<xsl:when test="$CountryType='BA'">Bosna-Hersek</xsl:when>
			<xsl:when test="$CountryType='BW'">Botsvana</xsl:when>
			<xsl:when test="$CountryType='BR'">Brezilya</xsl:when>
			<xsl:when test="$CountryType='BN'">Bruney</xsl:when>
			<xsl:when test="$CountryType='BG'">Bulgaristan</xsl:when>
			<xsl:when test="$CountryType='BF'">Burkina Faso</xsl:when>
			<xsl:when test="$CountryType='BI'">Burundi</xsl:when>
			<xsl:when test="$CountryType='TD'">Çad</xsl:when>
			<xsl:when test="$CountryType='KY'">Cayman Adaları</xsl:when>
			<xsl:when test="$CountryType='GI'">Cebelitarık (GB)</xsl:when>
			<xsl:when test="$CountryType='CZ'">Çek Cumhuriyeti</xsl:when>
			<xsl:when test="$CountryType='DZ'">Cezayir</xsl:when>
			<xsl:when test="$CountryType='DJ'">Cibuti</xsl:when>
			<xsl:when test="$CountryType='CN'">Çin</xsl:when>
			<xsl:when test="$CountryType='DK'">Danimarka</xsl:when>
			<xsl:when test="$CountryType='CD'">Demokratik Kongo Cumhuriyeti</xsl:when>
			<xsl:when test="$CountryType='TL'">Doğu Timor</xsl:when>
			<xsl:when test="$CountryType='DO'">Dominik Cumhuriyeti</xsl:when>
			<xsl:when test="$CountryType='DM'">Dominika</xsl:when>
			<xsl:when test="$CountryType='EC'">Ekvador</xsl:when>
			<xsl:when test="$CountryType='GQ'">Ekvator Ginesi</xsl:when>
			<xsl:when test="$CountryType='SV'">El Salvador</xsl:when>
			<xsl:when test="$CountryType='ID'">Endonezya</xsl:when>
			<xsl:when test="$CountryType='ER'">Eritre</xsl:when>
			<xsl:when test="$CountryType='AM'">Ermenistan</xsl:when>
			<xsl:when test="$CountryType='MF'">Ermiş Martin (FR)</xsl:when>
			<xsl:when test="$CountryType='EE'">Estonya</xsl:when>
			<xsl:when test="$CountryType='ET'">Etiyopya</xsl:when>
			<xsl:when test="$CountryType='FK'">Falkland Adaları</xsl:when>
			<xsl:when test="$CountryType='FO'">Faroe Adaları (DK)</xsl:when>
			<xsl:when test="$CountryType='MA'">Fas</xsl:when>
			<xsl:when test="$CountryType='FJ'">Fiji</xsl:when>
			<xsl:when test="$CountryType='CI'">Fildişi Sahili</xsl:when>
			<xsl:when test="$CountryType='PH'">Filipinler</xsl:when>
			<xsl:when test="$CountryType='FI'">Finlandiya</xsl:when>
			<xsl:when test="$CountryType='FR'">Fransa</xsl:when>
			<xsl:when test="$CountryType='GF'">Fransız Guyanası (FR)</xsl:when>
			<xsl:when test="$CountryType='PF'">Fransız Polinezyası (FR)</xsl:when>
			<xsl:when test="$CountryType='GA'">Gabon</xsl:when>
			<xsl:when test="$CountryType='GM'">Gambiya</xsl:when>
			<xsl:when test="$CountryType='GH'">Gana</xsl:when>
			<xsl:when test="$CountryType='GN'">Gine</xsl:when>
			<xsl:when test="$CountryType='GW'">Gine Bissau</xsl:when>
			<xsl:when test="$CountryType='GD'">Grenada</xsl:when>
			<xsl:when test="$CountryType='GL'">Grönland (DK)</xsl:when>
			<xsl:when test="$CountryType='GP'">Guadeloupe (FR)</xsl:when>
			<xsl:when test="$CountryType='GT'">Guatemala</xsl:when>
			<xsl:when test="$CountryType='GG'">Guernsey (GB)</xsl:when>
			<xsl:when test="$CountryType='ZA'">Güney Afrika</xsl:when>
			<xsl:when test="$CountryType='KR'">Güney Kore</xsl:when>
			<xsl:when test="$CountryType='GE'">Gürcistan</xsl:when>
			<xsl:when test="$CountryType='GY'">Guyana</xsl:when>
			<xsl:when test="$CountryType='HT'">Haiti</xsl:when>
			<xsl:when test="$CountryType='IN'">Hindistan</xsl:when>
			<xsl:when test="$CountryType='HR'">Hırvatistan</xsl:when>
			<xsl:when test="$CountryType='NL'">Hollanda</xsl:when>
			<xsl:when test="$CountryType='HN'">Honduras</xsl:when>
			<xsl:when test="$CountryType='HK'">Hong Kong (CN)</xsl:when>
			<xsl:when test="$CountryType='VG'">İngiliz Virjin Adaları</xsl:when>
			<xsl:when test="$CountryType='IQ'">Irak</xsl:when>
			<xsl:when test="$CountryType='IR'">İran</xsl:when>
			<xsl:when test="$CountryType='IE'">İrlanda</xsl:when>
			<xsl:when test="$CountryType='ES'">İspanya</xsl:when>
			<xsl:when test="$CountryType='IL'">İsrail</xsl:when>
			<xsl:when test="$CountryType='SE'">İsveç</xsl:when>
			<xsl:when test="$CountryType='CH'">İsviçre</xsl:when>
			<xsl:when test="$CountryType='IT'">İtalya</xsl:when>
			<xsl:when test="$CountryType='IS'">İzlanda</xsl:when>
			<xsl:when test="$CountryType='JM'">Jamaika</xsl:when>
			<xsl:when test="$CountryType='JP'">Japonya</xsl:when>
			<xsl:when test="$CountryType='JE'">Jersey (GB)</xsl:when>
			<xsl:when test="$CountryType='KH'">Kamboçya</xsl:when>
			<xsl:when test="$CountryType='CM'">Kamerun</xsl:when>
			<xsl:when test="$CountryType='CA'">Kanada</xsl:when>
			<xsl:when test="$CountryType='ME'">Karadağ</xsl:when>
			<xsl:when test="$CountryType='QA'">Katar</xsl:when>
			<xsl:when test="$CountryType='KZ'">Kazakistan</xsl:when>
			<xsl:when test="$CountryType='KE'">Kenya</xsl:when>
			<xsl:when test="$CountryType='CY'">Kıbrıs</xsl:when>
			<xsl:when test="$CountryType='KG'">Kırgızistan</xsl:when>
			<xsl:when test="$CountryType='KI'">Kiribati</xsl:when>
			<xsl:when test="$CountryType='CO'">Kolombiya</xsl:when>
			<xsl:when test="$CountryType='KM'">Komorlar</xsl:when>
			<xsl:when test="$CountryType='CG'">Kongo Cumhuriyeti</xsl:when>
			<xsl:when test="$CountryType='KV'">Kosova (RS)</xsl:when>
			<xsl:when test="$CountryType='CR'">Kosta Rika</xsl:when>
			<xsl:when test="$CountryType='CU'">Küba</xsl:when>
			<xsl:when test="$CountryType='KW'">Kuveyt</xsl:when>
			<xsl:when test="$CountryType='KP'">Kuzey Kore</xsl:when>
			<xsl:when test="$CountryType='LA'">Laos</xsl:when>
			<xsl:when test="$CountryType='LS'">Lesoto</xsl:when>
			<xsl:when test="$CountryType='LV'">Letonya</xsl:when>
			<xsl:when test="$CountryType='LR'">Liberya</xsl:when>
			<xsl:when test="$CountryType='LY'">Libya</xsl:when>
			<xsl:when test="$CountryType='LI'">Lihtenştayn</xsl:when>
			<xsl:when test="$CountryType='LT'">Litvanya</xsl:when>
			<xsl:when test="$CountryType='LB'">Lübnan</xsl:when>
			<xsl:when test="$CountryType='LU'">Lüksemburg</xsl:when>
			<xsl:when test="$CountryType='HU'">Macaristan</xsl:when>
			<xsl:when test="$CountryType='MG'">Madagaskar</xsl:when>
			<xsl:when test="$CountryType='MO'">Makao (CN)</xsl:when>
			<xsl:when test="$CountryType='MK'">Makedonya</xsl:when>
			<xsl:when test="$CountryType='MW'">Malavi</xsl:when>
			<xsl:when test="$CountryType='MV'">Maldivler</xsl:when>
			<xsl:when test="$CountryType='MY'">Malezya</xsl:when>
			<xsl:when test="$CountryType='ML'">Mali</xsl:when>
			<xsl:when test="$CountryType='MT'">Malta</xsl:when>
			<xsl:when test="$CountryType='IM'">Man Adası (GB)</xsl:when>
			<xsl:when test="$CountryType='MH'">Marshall Adaları</xsl:when>
			<xsl:when test="$CountryType='MQ'">Martinique (FR)</xsl:when>
			<xsl:when test="$CountryType='MU'">Mauritius</xsl:when>
			<xsl:when test="$CountryType='YT'">Mayotte (FR)</xsl:when>
			<xsl:when test="$CountryType='MX'">Meksika</xsl:when>
			<xsl:when test="$CountryType='FM'">Mikronezya</xsl:when>
			<xsl:when test="$CountryType='EG'">Mısır</xsl:when>
			<xsl:when test="$CountryType='MN'">Moğolistan</xsl:when>
			<xsl:when test="$CountryType='MD'">Moldova</xsl:when>
			<xsl:when test="$CountryType='MC'">Monako</xsl:when>
			<xsl:when test="$CountryType='MR'">Moritanya</xsl:when>
			<xsl:when test="$CountryType='MZ'">Mozambik</xsl:when>
			<xsl:when test="$CountryType='MM'">Myanmar</xsl:when>
			<xsl:when test="$CountryType='NA'">Namibya</xsl:when>
			<xsl:when test="$CountryType='NR'">Nauru</xsl:when>
			<xsl:when test="$CountryType='NP'">Nepal</xsl:when>
			<xsl:when test="$CountryType='NE'">Nijer</xsl:when>
			<xsl:when test="$CountryType='NG'">Nijerya</xsl:when>
			<xsl:when test="$CountryType='NI'">Nikaragua</xsl:when>
			<xsl:when test="$CountryType='NO'">Norveç</xsl:when>
			<xsl:when test="$CountryType='CF'">Orta Afrika Cumhuriyeti</xsl:when>
			<xsl:when test="$CountryType='UZ'">Özbekistan</xsl:when>
			<xsl:when test="$CountryType='PK'">Pakistan</xsl:when>
			<xsl:when test="$CountryType='PW'">Palau</xsl:when>
			<xsl:when test="$CountryType='PA'">Panama</xsl:when>
			<xsl:when test="$CountryType='PG'">Papua Yeni Gine</xsl:when>
			<xsl:when test="$CountryType='PY'">Paraguay</xsl:when>
			<xsl:when test="$CountryType='PE'">Peru</xsl:when>
			<xsl:when test="$CountryType='PL'">Polonya</xsl:when>
			<xsl:when test="$CountryType='PT'">Portekiz</xsl:when>
			<xsl:when test="$CountryType='PR'">Porto Riko (US)</xsl:when>
			<xsl:when test="$CountryType='RE'">Réunion (FR)</xsl:when>
			<xsl:when test="$CountryType='RO'">Romanya</xsl:when>
			<xsl:when test="$CountryType='RW'">Ruanda</xsl:when>
			<xsl:when test="$CountryType='RU'">Rusya</xsl:when>
			<xsl:when test="$CountryType='BL'">Saint Barthélemy (FR)</xsl:when>
			<xsl:when test="$CountryType='KN'">Saint Kitts ve Nevis</xsl:when>
			<xsl:when test="$CountryType='LC'">Saint Lucia</xsl:when>
			<xsl:when test="$CountryType='PM'">Saint Pierre ve Miquelon (FR)</xsl:when>
			<xsl:when test="$CountryType='VC'">Saint Vincent ve Grenadinler</xsl:when>
			<xsl:when test="$CountryType='WS'">Samoa</xsl:when>
			<xsl:when test="$CountryType='SM'">San Marino</xsl:when>
			<xsl:when test="$CountryType='ST'">São Tomé ve Príncipe</xsl:when>
			<xsl:when test="$CountryType='SN'">Senegal</xsl:when>
			<xsl:when test="$CountryType='SC'">Seyşeller</xsl:when>
			<xsl:when test="$CountryType='SL'">Sierra Leone</xsl:when>
			<xsl:when test="$CountryType='CL'">Şili</xsl:when>
			<xsl:when test="$CountryType='SG'">Singapur</xsl:when>
			<xsl:when test="$CountryType='RS'">Sırbistan</xsl:when>
			<xsl:when test="$CountryType='SK'">Slovakya Cumhuriyeti</xsl:when>
			<xsl:when test="$CountryType='SI'">Slovenya</xsl:when>
			<xsl:when test="$CountryType='SB'">Solomon Adaları</xsl:when>
			<xsl:when test="$CountryType='SO'">Somali</xsl:when>
			<xsl:when test="$CountryType='SS'">South Sudan</xsl:when>
			<xsl:when test="$CountryType='SJ'">Spitsbergen (NO)</xsl:when>
			<xsl:when test="$CountryType='LK'">Sri Lanka</xsl:when>
			<xsl:when test="$CountryType='SD'">Sudan</xsl:when>
			<xsl:when test="$CountryType='SR'">Surinam</xsl:when>
			<xsl:when test="$CountryType='SY'">Suriye</xsl:when>
			<xsl:when test="$CountryType='SA'">Suudi Arabistan</xsl:when>
			<xsl:when test="$CountryType='SZ'">Svaziland</xsl:when>
			<xsl:when test="$CountryType='TJ'">Tacikistan</xsl:when>
			<xsl:when test="$CountryType='TZ'">Tanzanya</xsl:when>
			<xsl:when test="$CountryType='TH'">Tayland</xsl:when>
			<xsl:when test="$CountryType='TW'">Tayvan</xsl:when>
			<xsl:when test="$CountryType='TG'">Togo</xsl:when>
			<xsl:when test="$CountryType='TO'">Tonga</xsl:when>
			<xsl:when test="$CountryType='TT'">Trinidad ve Tobago</xsl:when>
			<xsl:when test="$CountryType='TN'">Tunus</xsl:when>
			<xsl:when test="$CountryType='TR'">Türkiye</xsl:when>
			<xsl:when test="$CountryType='TM'">Türkmenistan</xsl:when>
			<xsl:when test="$CountryType='TC'">Turks ve Caicos</xsl:when>
			<xsl:when test="$CountryType='TV'">Tuvalu</xsl:when>
			<xsl:when test="$CountryType='UG'">Uganda</xsl:when>
			<xsl:when test="$CountryType='UA'">Ukrayna</xsl:when>
			<xsl:when test="$CountryType='OM'">Umman</xsl:when>
			<xsl:when test="$CountryType='JO'">Ürdün</xsl:when>
			<xsl:when test="$CountryType='UY'">Uruguay</xsl:when>
			<xsl:when test="$CountryType='VU'">Vanuatu</xsl:when>
			<xsl:when test="$CountryType='VA'">Vatikan</xsl:when>
			<xsl:when test="$CountryType='VE'">Venezuela</xsl:when>
			<xsl:when test="$CountryType='VN'">Vietnam</xsl:when>
			<xsl:when test="$CountryType='WF'">Wallis ve Futuna (FR)</xsl:when>
			<xsl:when test="$CountryType='YE'">Yemen</xsl:when>
			<xsl:when test="$CountryType='NC'">Yeni Kaledonya (FR)</xsl:when>
			<xsl:when test="$CountryType='NZ'">Yeni Zelanda</xsl:when>
			<xsl:when test="$CountryType='CV'">Yeşil Burun Adaları</xsl:when>
			<xsl:when test="$CountryType='GR'">Yunanistan</xsl:when>
			<xsl:when test="$CountryType='ZM'">Zambiya</xsl:when>
			<xsl:when test="$CountryType='ZW'">Zimbabve</xsl:when>
			<xsl:otherwise>
				<xsl:value-of select="$CountryType"/>
			</xsl:otherwise>
		</xsl:choose>
	</xsl:template>
	<xsl:template name='Party_Other'>
		<xsl:param name="PartyType"/>
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
		<xsl:if test="$PartyType!='TAXFREE' and $PartyType!='EXPORT'">
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
		<xsl:if test="@currencyID">
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