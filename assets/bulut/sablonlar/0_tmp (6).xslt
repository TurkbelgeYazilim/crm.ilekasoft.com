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