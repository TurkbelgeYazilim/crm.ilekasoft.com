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
								<img style="width:220px;" align="right" alt="Company Logo" src="data:image/jpeg;base64,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zzzzzzzzUDcIAAAAAAAAABfzzWzwAKj5SzTFK27a0BPT0AAAAAAAAADSEPTzzzzzzzzzyADQMAAAAAAAAAInw1QLw6ahhatOh0+664AVxkAAAAAAAAABUIBbzzzzzzzzzyIDakAAAAAAAAAD7wIyrwAGgD2tKID/ADyWiA8pAAAAAAAAAAfoA08888888888yA0IAAAAAAIAAA+8Qwg8ABoA9rA8IegA0jA8pAAAAAAAAAAeKA08888888888iA2jAAAAAAgAAAAQAQAAAQQAAgAAgAgAAQAgAAAAAAAAAAAVgA08888888888GA1BAAAAAy+yg0yASyAzY9HrDJiRGxl3U6i3wAAvTgAAAAAXDAU88888888887A9gAAAAAAUAUBOACoAEZhVrFBqORjA1EcKWpmKPBAAAAAA+pF88888888888+A/KAAAAAAUAUBUAA4c2AAUpUAo8CBwoCWRf8010BAAAAAA0pE88888888888uIC+AAAAAAUAUBUAJoAxpAcpUAo8kAJYCWB1qi5UBAAAAAB4AA888888888888CU4AAAAAKeOSGbRDqInTEXlAGC7PBSfAWJHkRNXDIAAAAG7A8888888888888kAXIAAAAAAAQAeANMaCc8CACAASCZlKWYiAAACAAAAAAAWpBW888888888888tAUrAAAAAAAAAAAAAAAAAAAAAAAAW3AAAAAAAAAAAAAABsBT88888888888888CXuDAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAHxAU88888888888888LAbJAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAHeJQ8888888888888888oVmhAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAlxAf8888888888888888YA0+AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAUYDC888888888888888888vB1CAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAADb7Eu8888888888888888888LU8gAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAkpAC888888888888888888884ID0iAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAvqgW8888888888888888888888vARsiAAAAAAAAAAAAAAAAAAAAAAAAAAAAA3hjB888888888888888888888888sAXsjAAAAAAAAAAAAAAAAAAAAAAAAAADkijDX8888888888888888888888888oAyhNLAAAAAAAAAAAAAAAAAAAAAAAMbpgBv888888888888888888888888888bBTzHnAAAAAAAAAAAAAAAAAAAAHtQDAYc88888888888888888888888888888dCAgxNDAAAAAAAAAAAAAAAABHcjjAc88888888888888888888888888888888sODAjysNABAAAAAAAAABGO4zhAAd88888888888888888888888888888888888MODARk2q/sNffdf8AqP58wQAjHPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPrTgAEAE00kEkQEwAAw/XPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPHDxiCQwAAQyjR3XPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPHHHPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPAP//aAAwDAQACAAMAAAAQ9999999999999999999999999999999999999999999999999999999999998999999999999999999999999999999999999999999999999999999999999899999999999999999999999999999999999999999999999999999999999989999999999999999999999999999999999999999999999999999999999998999999999999999999999999999999999999999999999999999999999999899999999999999999999999995x+yRQwST31799999999999999999999999899999999999999999999995xCiBBBBBBBBBBBAVw999999999999999999998999999999999999999991IiBECH8Osd/P/evGNBBAd39999999999999999989999999999999999994rhFCmb+4zQRQgSxBgxoPhFBxe9999999999999999899999999999999999piFTPyYQBBBBBBBBBBBBRT7m7HBT3999999999999998999999999999999+YBE28ShBBBBBBBBBBBBBBBBBBy+lACe99999999999998999999999999999wBB6ShBBBBBBBBBBBBBBBBBBBBBBbYERT99999999999989999999999999nhGkmRBBBBBBBBBBBBBBBBBBBBBBBBRgkGBA1999999999989999999999999hC2sgBBBBBBBBBBBBBBBBBBBBBBBBBBB1knBW9999999999899999999999/IGulBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBUsIB6999999999899999999999YBk0BBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBAsvQS99999999899999999995BBigBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBAnKB9999999989999999994iE6JBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBB+pBS99999998999999999zFuKBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBStiAV999999899999999thL8hBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBA+Bx999999899999999QF3iBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBB+IB+99999899999995CCqhBBBBBBBBBBBBBBBDEBBBBBBBBBBBBBBBBBBBBBBUsBn9999989999999tBmYBBBBBBBBBBBBBBBBwsBBBBBBBBBBBBBBBBBBBBBBR2oV9999989999999CG7pBBBBBBBBFRMgBVMvDJLHMaKBBOeHSZHZKBBBBBBBB+FB+999989999995AW6BBBBBBBBBTq8qHW8qi/gUUC2DR88C90xj8BBBBBBBBF6B2999989999999BHoBBBBBBBBBBpsXEN0rp/pUFleocVZAS86XBBBBBBBBBQ9AD99998999999+B8iBBBBBBBBBBpoK7YUrp/pUa4aDDeqBBXcSrBBBBBBBBBfoW99998999999qBeIBBBBBBBBBBp40fgUrp/pUzcrSDp28B9koBBBBBBBBBB0rW99998999999JB0pBBBBBBBBBFmos/iUqB/ceBSrUOuO6Lk07BBBBBBBBBBVIB19998999999oBdIBBBBBBBBBB9oGceUrB/B8BF+LO6x2pB/DBBBBBBBBBBwhBU99989999994B/pBBBBBBABBB9oHoXUrB/B8BI/g9oBXNB/DBBBBBBBBBBBDBU9998999999oBXKBBBBBBgBBBDDBjRDBTTBDDgDDDLBDgBDDBBBBBBBBBB2qB09998999999rB/pBBBBBS9yQjWBR1wxYkxyH5pPUznlUxRR/BBiaDBBBBBVLF/wDfffPfffffawXoQQQQQQawVwDQQfwVH7wzjb4TQ6TEx3zQoAhjgwQQQQQXaF/ffffPfffffbQf4AQQQQQawVwAAaLxHawQAwAa/EhqzFlbzVMzFAwQQQQQfI0fffffPfffffegVqAQQQQQawVwAB6fwc0wIAwAa/HMC31lady8a1AwQQQQVegTvffffPffffffQkKCQQQQQfRWlRSAcSLRgwRHhQfToyskE52b160RgwQQQXoQdPffffPffffffSQf4wQQQU84488s2wAssMMc8k80kQyEoY4s8wcs8wQQQQXwgNvffffPfffffffARbwQQQQQQQQQQQQQQQQQQQQQQQRQQQQQQQQQQQQQQQQ/IEPfffffPfffffffQEfiQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQRMgbPfffffPfffffffbQf6gQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQRWoxP/fffffPfffffffbyE7iQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQRagV/ffffffPffffffffXAUXyQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQ6oAn/ffffffPffffffffbbgMJAQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQRnaAVffffffffPfffffffffeAELCQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQQVPgQPffffffffPffffffffffXQcpBgQQQQQQQQQQQQQQQQQQQQQQQQQQQQQRX9wXX/ffffffffPfffffffffffTAY5CAQQQQQQQQQQQQQQQQQQQQQQQQQQQQX5gg/PfffffffffPfffffffffffbZwUNDAQQQQQQQQQQQQQQQQQQQQQQQQQRjMwhTfffffffffffPffffffffffffbbQZZ3igQQQQQQQQQQQQQQQQQQQQQQQ3ZgQ1ffffffffffffPffffffffffffffSwAnfRAQQQQQQQQQQQQQQQQQQQRTesgR3PffffffffffffPfffffffffffffffSBgUdHgAQQQQQQQQQQQQQQQQxGOAgUX/fffffffffffffPffffffffffffffffb6ykcsfnjSAQQQQQQQQT3n/ACDMEdz333333333333333z3333333333333333331wgoEEP3L8w2ADZ03jWuAAEQ533333333333333333z3333333333333333333307oEkFHBKNDIDPPIEE5873333333333333333333z333333333333333333333331x0w00IEEAUw8x5/333333333333333333333z3333333333333333333333333333220+3333333333333333333333333333z333333333333333333333333333333333333333333333333333333333333z333333333333333333333333333333333333333333333333333333333333zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzwD//xAAzEQABAwIDBgYCAQQDAQAAAAABAAIDBBEQITESFDAyQWETICJAUYEFUEIVIzNxUmKRof/aAAgBAgEBPwD95Scn3+9pOT7/AHtJyff72k5Pv97Scn37oC+ibTyu0ahQynVD8eerkPx7erl/T4/krcI/kr+ns+Ufx46OR/Hv6FOo5h0To3t5h7ik5Pv27WOebNCjoHnmyTKKJuuaaxreUcR9PE/UJ/48HkKkpZWaj2tJyfftYoHycoUdCxub801oaLAYEgC5T6uFvW6d+QH8Wp1dKdMkamY/yRlk6uKL3fK2j8oSPGhKE8o0cUKyYdU38g/qE2vjOosmTRv5TjJTxycwUtC9ubM0QQbH2VJyffs44nyGzQoaJjc35lAW0wkq42ZXupK6R3LkiXvOeaZSSu6WTfx//IptFENc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"/><br/>
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