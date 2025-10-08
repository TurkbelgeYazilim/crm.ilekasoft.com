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