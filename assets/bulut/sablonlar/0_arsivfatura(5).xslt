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