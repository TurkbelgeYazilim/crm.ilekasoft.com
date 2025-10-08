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