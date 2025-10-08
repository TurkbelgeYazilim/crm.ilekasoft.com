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