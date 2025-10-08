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
								<img style="width:220px;" align="right" alt="Company Logo" src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/4gIoSUNDX1BST0ZJTEUAAQEAAAIYAAAAAAQwAABtbnRyUkdCIFhZWiAAAAAAAAAAAAAAAABhY3NwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQAA9tYAAQAAAADTLQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAlkZXNjAAAA8AAAAHRyWFlaAAABZAAAABRnWFlaAAABeAAAABRiWFlaAAABjAAAABRyVFJDAAABoAAAAChnVFJDAAABoAAAAChiVFJDAAABoAAAACh3dHB0AAAByAAAABRjcHJ0AAAB3AAAADxtbHVjAAAAAAAAAAEAAAAMZW5VUwAAAFgAAAAcAHMAUgBHAEIAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAFhZWiAAAAAAAABvogAAOPUAAAOQWFlaIAAAAAAAAGKZAAC3hQAAGNpYWVogAAAAAAAAJKAAAA+EAAC2z3BhcmEAAAAAAAQAAAACZmYAAPKnAAANWQAAE9AAAApbAAAAAAAAAABYWVogAAAAAAAA9tYAAQAAAADTLW1sdWMAAAAAAAAAAQAAAAxlblVTAAAAIAAAABwARwBvAG8AZwBsAGUAIABJAG4AYwAuACAAMgAwADEANv/bAEMAAwICAgICAwICAgMDAwMEBgQEBAQECAYGBQYJCAoKCQgJCQoMDwwKCw4LCQkNEQ0ODxAQERAKDBITEhATDxAQEP/bAEMBAwMDBAMECAQECBALCQsQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEP/AABEIAE8AaQMBIgACEQEDEQH/xAAWAAEBAQAAAAAAAAAAAAAAAAAAAQn/xAAXEAEAAwAAAAAAAAAAAAAAAAAAARFR/8QAFQEBAQAAAAAAAAAAAAAAAAAAAAH/xAAVEQEBAAAAAAAAAAAAAAAAAAAAEf/aAAwDAQACEQMRAD8A1QAAAAAAAAAAAAASAAoAAAAAAAAAAAAAAAAAAAAAAAAJU6oAAAAAAAAAAAAAAAAAAAAAAAAAAAAD/9k="/><br/>
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