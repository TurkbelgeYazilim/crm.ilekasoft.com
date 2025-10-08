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
				<title>E-Fatura</title>
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
										<xsl:text>E-Fatura</xsl:text>
									</span>
								</h1>
								<br/>
								<div class="imgBox" valign="middle">
									<img style="width:0px;"/>
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