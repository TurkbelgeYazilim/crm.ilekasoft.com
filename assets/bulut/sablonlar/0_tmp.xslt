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