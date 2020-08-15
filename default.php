<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>comics.org REST API Abstract</title>
    <link rel="shortcut icon" href="/images/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="../files/main.css">
    <style>
        body { background-color: #eecccc; }
        div:hover { background-color: #91D050 }
        .preview { box-shadow: 10px 10px 10px #999; }
        .warning { background-color: yellow; text-align: center; }
    </style>
</head>

<body>

<h2>comics.org data REST API methods</h2>
<b><ul>
<li>this page updated: <?=date("F d Y H:i:s", filemtime("default.php"))?> UTC. </li>
<li>MySQL data source: <a target="gcd" href="https://www.comics.org/download/">gcd data dump</a> 2020-08-15 03:41:16 </li>
<li>demo source control: <a target="github" href="https://github.com/ctgarry/api.comics.org">https://github.com/ctgarry/api.comics.org</a> </li>
</ul>
</b>

    <table border=0>
        <tr>
            <td valign=top>
                <table border=1>
                    <tr>
                        <td colspan=4>
                            <h3>Publisher</h3>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Verb</b></td>
                        <td><b>Example</b></td>
                        <td><b>Equivalent</b></td>
                        <td><b>Tables</b></td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td><a target="api" href="v1/publisher/54/">/v1/publisher/54/</a></td>
                        <td><a target="gcd" href="https://www.comics.org/publisher/54/"><img class=myB
                                    src="images/r/gcd.png" /></a>
                        </td>
                        <td>gcd_publisher</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>└─<a target="api" href="v1/publisher/?name=dc">/v1/publisher/?name=dc&page=1</a></td>
                        <td><a target="gcd" href="https://www.comics.org/searchNew/?q=dc&search_object=publisher"><img class=myB
                                    src="images/r/gcd.png" /></a>
                        </td>
                        <td>gcd_publisher</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>└─<a target="api" href="v1/publisher/54/brand_groups">/v1/publisher/54/brand_groups</a></td>
                        <td><a target="gcd" href="https://www.comics.org/publisher/54/brands"><img class=myB
                                    src="images/r/gcd.png" /></a></td>
                        <td>gcd_brand_group</td>
                        <!-- gcd_brand_group WHERE parent_id = 54 -->
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td><a target="api" href="v1/indicia_publisher/5">/v1/indicia_publisher/5</a></td>
                        <td><a target="gcd" href="https://www.comics.org/indicia_publisher/5"><img class=myB
                                    src="images/r/gcd.png" /></a></td>
                        <td>gcd_indicia_publisher</td>
                    </tr>
                    <tr>
                        <td colspan=4>
                            <h3>Series</h3>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Verb</b></td>
                        <td><b>Example</b></td>
                        <td><b>Equivalent</b></td>
                        <td><b>Tables</b></td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td><a target="api" href="v1/series/97">/v1/series/97</a></td>
                        <td><a target="gcd" href="https://www.comics.org/series/97"><img class=myB
                                    src="images/r/gcd.png" /></a>
                        </td>
                        <td>gcd_series</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>└─<a target="api" href="v1/series/?name=fantastic">/v1/series/?name=fantastic&page=1</a></td>
                        <td><a target="gcd" href="https://www.comics.org/searchNew/?q=fantastic&search_object=series"><img class=myB
                                    src="images/r/gcd.png" /></a>
                        </td>
                        <td>gcd_series</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>└─<a target="api" href="v1/series/97/brand_emblems">/v1/series/97/brand_emblems</a></td>
                        <td>(Publisher's Brands)</td>
                        <td>gcd_brand; gcd_issue</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>└─<a target="api" href="v1/series/97/indicia_publishers">/v1/series/97/indicia_publishers</a></td>
                        <td>(Indicia Publishers)</td>
                        <td>gcd_indicia_publisher; gcd_issue</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>└─<a target="api" href="v1/series/97/awards">/v1/series/97/awards</a></td>
                        <td>(Awards)</td>
                        <td>gcd_received_award; gcd_award</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>└─<a target="api" href="v1/series/72/bonds">/v1/series/72/bonds</a></td>
                        <td>(Tracking)</td>
                        <td>gcd_series_bond</td>
                    </tr>
                    <tr>
                        <td colspan=4>
                            <h3>Issues</h3>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Verb</b></td>
                        <td><b>Example</b></td>
                        <td><b>Equivalent</b></td>
                        <td><b>Tables</b></td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td><a target="api" href="v1/issue/7521">/v1/issue/7521</a></td>
                        <td><a target="gcd" href="https://www.comics.org/issue/7521"><img class=myB
                                    src="images/r/gcd.png" /></a>
                        </td>
                        <td>gcd_issue</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>└─<!--a target="api" href="v1/issue/7521/issue_reprints"-->/v1/issue/7521/issue_reprints</a></td>
                        <td>Parts of this issue are reprinted in another issue</td>
                        <td>gcd_issue_reprint</td>
                    </tr>
                    <!--
                        # ISSUE REPRINT
                        # "Parts of this issue are reprinted in another issue". Example:
                        SELECT ir.origin_issue_id, ir.target_issue_id 
                        FROM gcdprod.gcd_issue_reprint ir WHERE ir.id = 1;
                        # --- origin_issue_id=391286 target_issue_id=761531
                    -->
                    <tr>
                        <td>GET</td>
                        <td>└─<!--a target="api" href="v1/issue/536367/reprints_from_issue"-->/v1/issue/536367/reprints_from_issue</a></td>
                        <td>Parts of this issue are reprinted TO a specific STORY</td>
                        <td>gcd_reprint_from_issue</td>
                    </tr>
                    <!--
                        # REPRINT _FROM_ ISSUE
                        # "Parts of this issue are reprinted TO a specific STORY" Example:
                        SELECT rfi.origin_issue_id, stTo.issue_id AS to_issue, rfi.target_id
                        FROM gcdprod.gcd_reprint_from_issue rfi 
                        INNER JOIN " . $DBName . ".gcd_story stTo ON stTo.id = rfi.target_id
                        WHERE rfi.id = 47;
                        # --- origin_issue_id=536367 to_issue=636145 target_id=928788
                    -->
                    <tr>
                        <td>GET</td>
                        <td>└─<!--a target="api" href="v1/issue/303196/reprints_to_issue"-->/v1/issue/303196/reprints_to_issue</a></td>
                        <td>Parts of this issue are reprinted FROM a specific STORY</td>
                        <td>gcd_reprint_to_issue</td>
                    </tr>
                    <!--
                        # REPRINT _TO_ ISSUE
                        # "Parts of this issue are reprinted FROM a specific STORY" Example:
                        SELECT rti.origin_id, stFrom.issue_id AS from_issue, rti.target_issue_id 
                        FROM gcdprod.gcd_reprint_to_issue rti 
                        INNER JOIN " . $DBName . ".gcd_story stFrom ON stFrom.id = rti.origin_id
                        WHERE rti.id = 19;
                        # --- origin_id=506106 from_issue=303196 target_issue_id=636292
                    -->
                    <tr>
                        <td>GET</td>
                        <td>└─<!--a target="api" href="v1/issue/7521/stories"-->/v1/issue/7521/stories</a></td>
                        <td>(list of stories)</a>
                        </td>
                        <td>gcd_story</td>
                    </tr>
                    <tr>
                        <td colspan=4>
                            <h3>Brands</h3>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Verb</b></td>
                        <td><b>Example</b></td>
                        <td><b>Equivalent</b></td>
                        <td><b>Tables</b></td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td><a target="api" href="v1/brand_emblem/4">/v1/brand_emblem/4</a></td>
                        <td><a target="gcd" href="https://www.comics.org/brand_emblem/4"><img class=myB
                                    src="images/r/gcd.png" /></a></td>
                        <td>gcd_brand</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>└─<!--a target="api" href="v1/brand_emblem/4/groups"-->/v1/brand_emblem/4/groups</a></td>
                        <td>(Brand Groups)</td>
                        <td>gcd_brand_emblem_group</td>
                        <!-- gcd_brand_emblem_group WHERE brand_id = 4 -->
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>└─<!--a target="api"
                                href="v1/brand_emblem/4/publisher_brand_uses"-->/v1/brand_emblem/4/publisher_brand_uses</a></td>
                        <td>(At Publishers)</td>
                        <td>gcd_brand_use</td>
                        <!-- gcd_brand_use WHERE emblem_id = 4 -->
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td><a target="api" href="v1/brand_group/1563">/v1/brand_group/1563</a></td>
                        <td><a target="gcd" href="https://www.comics.org/brand_group/1563"><img class=myB
                                    src="images/r/gcd.png" /></a></td>
                        <td>gcd_brand_group</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>└─<!--a target="api" href="v1/brand_group/1563/brand_use"-->/v1/brand_group/1563/emblem_brand_uses</a>
                        </td>
                        <td>(Used Brand Emblems)</td>
                        <td>gcd_brand_use</td>
                        <!-- gcd_brand_use WHERE publisher_id = 54 AND (year_began < 1970) AND (year_ended > 1949) -->
                    </tr>
                    <tr>
                        <td colspan=4>
                            <h3>Brand-Related Items</h3>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Verb</b></td>
                        <td><b>Example</b></td>
                        <td><b>Equivalent</b></td>
                        <td><b>Tables</b></td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td><a target="api" href="v1/brand_use/5256">/v1/brand_use/5256</a></td>
                        <td>-</td>
                        <td>gcd_brand_use</td>
                        <!-- gcd_brand_use WHERE emblem_id = 4 -->
                    </tr>
                    <tr>
                        <td colspan=4>
                            <h3>Stories</h3>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Verb</b></td>
                        <td><b>Example</b></td>
                        <td><b>Equivalent</b></td>
                        <td><b>Tables</b></td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td><a target="api" href="v1/story/2782805">/v1/story/2782805</a></td>
                        <td><a target="gcd" href="https://www.comics.org/issue/2041913/#2782805"><img class=myB
                                    src="images/r/gcd.png" /></a>
                        </td>
                        <td>gcd_story</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>└─<!--a target="api" href="v1/story/2782805/credits"-->/v1/story/2782805/credits</a></td>
                        <td>(creator object credits)</a>
                        <td>gcd_story_credit</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>└─<!--a target="api" href="v1/story/209149/reprints"-->/v1/story/209149/reprints</a></td>
                        <td>This story is reprinted as another story</td>
                        <td>gcd_reprint</td>
                    </tr>
                    <!--
                        # REPRINT
                        # "This story is reprinted as another story" Example:
                        SELECT stFrom.issue_id AS from_issue, r.origin_id, 
                            stTo.issue_id AS to_issue, r.target_id 
                        FROM gcdprod.gcd_reprint r
                        INNER JOIN " . $DBName . ".gcd_story stFrom ON stFrom.id = r.origin_id
                        INNER JOIN " . $DBName . ".gcd_story stTo ON stTo.id = r.target_id
                        WHERE r.id = 1;
                        # --- from_issue=35078 origin_id=209149 to_issue=635839 target_id=902285
                    -->
                    <tr>
                        <td>GET</td>
                        <td>└─<!--a target="api" href="v1/story/928788/reprints_from_issue"-->/v1/story/928788/reprints_from_issue</a></td>
                        <td>Parts of this issue are reprinted TO a specific STORY</td>
                        <td>gcd_reprint_from_issue</td>
                    </tr>
                    <!--
                        # REPRINT _FROM_ ISSUE
                        # "Parts of this issue are reprinted TO a specific STORY" Example:
                        SELECT rfi.origin_issue_id, stTo.issue_id AS to_issue, rfi.target_id
                        FROM gcdprod.gcd_reprint_from_issue rfi 
                        INNER JOIN " . $DBName . ".gcd_story stTo ON stTo.id = rfi.target_id
                        WHERE rfi.id = 47;
                        # --- origin_issue_id=536367 to_issue=636145 target_id=928788
                    -->
                    <tr>
                        <td>GET</td>
                        <td>└─<!--a target="api" href="v1/story/506106/reprints_to_issue"-->/v1/story/506106/reprints_to_issue</a></td>
                        <td>Parts of this issue are reprinted FROM a specific STORY</td>
                        <td>gcd_reprint_to_issue</td>
                    </tr>
                    <!--
                        # REPRINT _TO_ ISSUE
                        # "Parts of this issue are reprinted FROM a specific STORY" Example:
                        SELECT rti.origin_id, stFrom.issue_id AS from_issue, rti.target_issue_id 
                        FROM gcdprod.gcd_reprint_to_issue rti 
                        INNER JOIN " . $DBName . ".gcd_story stFrom ON stFrom.id = rti.origin_id
                        WHERE rti.id = 19;
                        # --- origin_id=506106 from_issue=303196 target_issue_id=636292
                    -->
                    <tr>
                        <td colspan=4>
                            <h3>Creators</h3>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Verb</b></td>
                        <td><b>Example</b></td>
                        <td><b>Equivalent</b></td>
                        <td><b>Tables</b></td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td><a target="api" href="v1/creator/11642">/v1/creator/11642</a></td>
                        <td><a target="gcd" href="https://www.comics.org/creator/11642"><img class=myB
                                    src="images/r/gcd.png" /></a></td>
                        <td>gcd_creator</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>└─<a target="api" href="v1/creator/?name=davis">/v1/creator/?name=davis&page=1</a></td>
                        <td><a target="gcd" href="https://www.comics.org/searchNew/?q=davis&search_object=creator"><img class=myB
                                    src="images/r/gcd.png" /></a></td>
                        <td>gcd_creator</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>└─<!--a target="api" href="v1/creator/11642/names"-->/v1/creator/11642/names</a></td>
                        <td>(Names)</td>
                        <td>gcd_creator_name_detail</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>└─<!--a target="api" href="v1/creator/11642/schools"-->/v1/creator/11642/schools</a></td>
                        <td>(Schools)</td>
                        <td>gcd_creator_school</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>└─<!--a target="api" href="v1/creator/11642/degrees"-->/v1/creator/11642/degrees</a></td>
                        <td>(Degrees)</td>
                        <td>gcd_creator_degree</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>└─<!--a target="api" href="v1/creator/11642/awards"-->/v1/creator/11642/awards</a></td>
                        <td>(Awards)</td>
                        <td>gcd_received_award</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>└─<!--a target="api" href="v1/creator/11642/art_influences"-->/v1/creator/11642/art_influences</a></td>
                        <td>(Art Influences)</td>
                        <td>gcd_creator_art_influence</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>└─<!--a target="api" href="v1/creator/11642/memberships"-->/v1/creator/11642/memberships</a></td>
                        <td>(Memberships)</td>
                        <td>gcd_creator_membership</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>└─<!--a target="api" href="v1/creator/11642/non_comic_works"-->/v1/creator/11642/non_comic_works</a>
                        </td>
                        <td>(Non Comics Works)</td>
                        <td>gcd_creator_non_comic_work</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>└─<!--a target="api"
                                href="v1/creator/11642/non_comic_work/1575/years"-->/v1/creator/11642/non_comic_work/1575/years</a>
                        </td>
                        <td>((Non Comics Work Years))</td>
                        <td>gcd_non_comic_work_year</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>└─<!--a target="api" href="v1/creator/11642/relation"-->/v1/creator/11642/relation</a></td>
                        <td>(Relations)</td>
                        <td>gcd_creator_relation</td>
                    </tr>
                    <tr>
                        <td colspan=4>
                            <h3>Creator-Related Items</h3>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Verb</b></td>
                        <td><b>Example</b></td>
                        <td><b>Equivalent</b></td>
                        <td><b>Tables</b></td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td><a target="api" href="v1/creator_school/607">/v1/creator_school/607</a></td>
                        <td><a target="gcd" href="https://www.comics.org/creator_school/607/"><img class=myB
                                    src="images/r/gcd.png" /></a>
                        <td>gcd_school</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td><a target="api" href="v1/award/6">/v1/award/6</a> </td>
                        <td><a target="gcd" href="https://www.comics.org/award/6/"><img class=myB
                                    src="images/r/gcd.png" /></a>
                        <td>gcd_award</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td><a target="api" href="v1/received_award/4938">/v1/received_award/4938</a></td>
                        <td><a target="gcd" href="https://www.comics.org/received_award/4938/"><img class=myB
                                    src="images/r/gcd.png" /></a>
                        <td>gcd_received_award</td>
                    </tr>
                    <tr>
                        <td colspan=4>
                            <h3>Features</h3>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Verb</b></td>
                        <td><b>Example</b></td>
                        <td><b>Equivalent</b></td>
                        <td><b>Tables</b></td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td><a target="api" href="v1/feature/98/">/v1/feature/98/</a></td>
                        <td><a target="gcd" href="https://www.comics.org/feature/98/"><img class=myB
                                    src="images/r/gcd.png" /></a>
                        <td>gcd_feature</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>└─<!--a target="api" href="v1/feature/98/logos"-->/v1/feature/98/logos</a></td>
                        <td>(Feature Logos)</td>
                        <td>gcd_feature_logo_2_feature</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>└─<a!-- target="api" href="v1/feature/98/feature_relations"-->/v1/feature/98/feature_relations</a></td>
                        <td>(Feature Relations)</td>
                        <td>gcd_feature_2_feature</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td colspan=2>(Stories having this feature)</td>
                        <td>gcd_story_feature_object</td>
                    </tr>
                    <tr>
                        <td colspan=4>
                            <h3>Feature Logos</h3>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Verb</b></td>
                        <td><b>Example</b></td>
                        <td><b>Equivalent</b></td>
                        <td><b>Tables</b></td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td><a target="api" href="v1/feature_logo/93/">/v1/feature_logo/93/</a> </td>
                        <td><a target="gcd" href="https://www.comics.org/feature_logo/93/"><img class=myB
                                    src="images/r/gcd.png" /></a>
                        <td>gcd_feaure_logo</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td colspan=2>(Stories having this logo)</td>
                        <td>gcd_story_feature_logo</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <h2>Supporting Tables</h2>
    <table>
        <tr>
            <td valign=top>
                <table border=1>
                    <tr>
                        <td colspan=4>
                            <h3>supporting tables</h3>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Verb</b></td>
                        <td><b>Example</b></td>
                        <td><b>Note</b></td>
                        <td><b>Tables</b></td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>-</td>
                        <td>(135 types)</td>
                        <td>django_content_type</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td><a target="api" href="v1/countries/">/v1/countries</a></td>
                        <td>(269 countries)</td>
                        <td>stddata_country</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>└─<a target="api" href="v1/country/225">/v1/country/225</a></td>
                        <td>by id</td>
                        <td>stddata_country</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td><a target="api" href="v1/languages/">/v1/languages</a></td>
                        <td>(153 languages)</td>
                        <td>stddata_language</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>└─<a target="api" href="v1/language/25">/v1/language/25</a></td>
                        <td>by id</td>
                        <td>stddata_language</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td><a target="api" href="v1/date/6">/v1/date/6</a></td>
                        <td>(250k+)</td>
                        <td>stddata_date</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td><a target="api" href="v1/tag/10">/v1/tag/10</a></td>
                        <td>(56k+)</td>
                        <td>taggit_tag</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td><a target="api" href="v1/taggeditem/7972">/v1/taggeditem/7972</a></td>
                        <td>(350k+)</td>
                        <td>taggit_taggeditem</td>
                    </tr>
                </table>
            </td>
            <td valign=top>
                <table border=1>
                    <tr>
                        <td colspan=4>
                            <h3>types</h3>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Verb</b></td>
                        <td><b>Example</b></td>
                        <td><b>Note</b></td>
                        <td><b>Tables</b></td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td><a target="api" href="v1/series_publication_types/">/v1/series_publication_types</a></td>
                        <td>(3 types)</td>
                        <td>gcd_series_publication_type</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>└─<a target="api" href="v1/series_publication_type/1">/v1/series_publication_type/1</a></td>
                        <td>by id</td>
                        <td>gcd_series_publication_type</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td><a target="api" href="v1/series_bond_types/">/v1/series_bond_types</a></td>
                        <td>(6 types)</td>
                        <td>gcd_series_bond_type</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>└─<a target="api" href="v1/series_bond_type/1">/v1/series_bond_type/1</a></td>
                        <td>by id</td>
                        <td>gcd_series_bond_type</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td><a target="api" href="v1/story_types/">/v1/story_types</a></td>
                        <td>(28 types)</td>
                        <td>gcd_story_type</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>└─<a target="api" href="v1/story_type/1">/v1/story_type/1</a></td>
                        <td>by id</td>
                        <td>gcd_story_type</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td><a target="api" href="v1/credit_types/">/v1/credit_types</a></td>
                        <td>(13 types)</td>
                        <td>gcd_credit_type</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>└─<a target="api" href="v1/credit_type/1">/v1/credit_type/1</a></td>
                        <td>by id</td>
                        <td>gcd_credit_type</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td><a target="api" href="v1/feature_types/">/v1/feature_types</a></td>
                        <td>(3 types)</td>
                        <td>gcd_feature_type</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>└─<a target="api" href="v1/feature_type/1">/v1/feature_type/1</a></td>
                        <td>by id</td>
                        <td>gcd_feature_type</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td><a target="api" href="v1/feature_relation_types/">/v1/feature_relation_types</a></td>
                        <td>(1 type)</td>
                        <td>gcd_feature_relation_type</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>└─<a target="api" href="v1/feature_relation_type/1">/v1/feature_relation_type/1</a></td>
                        <td>by id</td>
                        <td>gcd_feature_relation_type</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td><a target="api" href="v1/name_types/">/v1/name_types</a></td>
                        <td>(10 types)</td>
                        <td>gcd_name_type</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>└─<a target="api" href="v1/name_type/1">/v1/name_type/1</a></td>
                        <td>by id</td>
                        <td>gcd_name_type</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td><a target="api" href="v1/degrees/">/v1/degrees</a></td>
                        <td>(8 degrees)</td>
                        <td>gcd_degree</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>└─<a target="api" href="v1/degree/1">/v1/degree/1</a></td>
                        <td>by id</td>
                        <td>gcd_degree</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td><a target="api" href="v1/membership_types/">/v1/membership_types</a></td>
                        <td>(3 types)</td>
                        <td>gcd_membership_type</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>└─<a target="api" href="v1/membership_type/1">/v1/membership_type/1</a></td>
                        <td>by id</td>
                        <td>gcd_membership_type</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td><a target="api" href="v1/non_comic_work_types/">/v1/non_comic_work_types</a></td>
                        <td>(12 types)</td>
                        <td>gcd_non_comic_work_type</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>└─<a target="api" href="v1/non_comic_work_type/1">/v1/non_comic_work_type/1</a></td>
                        <td>by id</td>
                        <td>gcd_non_comic_work_type</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td><a target="api" href="v1/non_comic_work_roles/">/v1/non_comic_work_roles</a></td>
                        <td>(12 roles)</td>
                        <td>gcd_non_comic_work_role</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>└─<a target="api" href="v1/non_comic_work_role/1">/v1/non_comic_work_role/1</a></td>
                        <td>by id</td>
                        <td>gcd_non_comic_work_role</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td><a target="api" href="v1/relation_types/">/v1/relation_types</a></td>
                        <td>(8 types)</td>
                        <td>gcd_relation_type</td>
                    </tr>
                    <tr>
                        <td>GET</td>
                        <td>└─<a target="api" href="v1/relation_type/1">/v1/relation_type/1</a></td>
                        <td>by id</td>
                        <td>gcd_relation_type</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <br>

    <h2>Tools for reading the output:</h2>
    <a target="formatter" href="http://jsonviewer.stack.hu/">http://jsonviewer.stack.hu</a><br>

    <h2>Tools for sending the requests:</h2>
    <a target="emulators" href="https://www.postman.com/">"POSTMan" REST API Emulator</a><br>
    <a target="emulators" href="https://www.soapui.org/">"SOAPUI" REST API Emulator</a><br>
    <a target="emulators" href="https://www.google.com/search?q=advanced+rest+client">"Advanced Rest Client" REST API Emulator</a><br>
    etc...<br><br><br>
</body>

</html>

<?php
/********************************************
 * NOTES
 *  
	get_result()
	  Pros: Works with all SQL statements, Uses fetch_assoc()
	  Cons: array variables $row[], Not as neat, 
		requires MySQL native driver (mysqlnd)

	bind_result() <-- use this
	  Pros: simpler; no need for $row['name']; uses fetch()
	  Cons: Doesn't work with SQL query that use *

	Binding parameters:
		Note query q-mark: " ... WHERE id = ?"; params are separate
		types: s = string, i = integer, d = double,  b = blob
		example: $params= array("ii", $int1, $int2);
		old: call_user_func_array(array($stmt, 'bind_param'), $params);
		wtf?: $stmt->bind_param($param_types, ...$params); // exact code splat

	free results; close statement; close connection!

	if ($logging) { 
		echo "{'\$param_types': " . json_encode($params_types) . "}," . PHP_EOL; 
		echo "{'\$params': " . json_encode($params) . "}," . PHP_EOL; 
		echo "{'\$query': " . json_encode($query) . "}," . PHP_EOL; 
	}

	if ($logging) { printf("{'Fieldname': " . json_encode('%s') . "}" . PHP_EOL, $field->name); }

	if ($logging) { var_dump($pointers); }
	call_user_func_array(array( $stmt, 'bind_result' ) , $pointers);
	call_user_func_array('mysqli_stmt_bind_result', array_merge(array($stmt), $pointers));

	$mysqli->next_result();

	With PHP version 7.2 I just used nd_mysqli instead of mysqli and it worked as expected.
	Steps to enable it into godaddy hosting server-
	Login to cpanel.
	Click on "Select PHP version".
	As provided the snapshot of the latest configurations uncheck "mysqli" and enable "nd_mysqli".

    echo         __DIR__;  // C:\Apache24\htdocs\blackbox\bymonth\api
    echo dirname(__DIR__); // C:\Apache24\htdocs\blackbox\bymonth

    Accept: application/json

    curl --location --request GET 'http://localhost/blackbox/bymonth/api/v1/publishers/' \
    --header 'x-gcd-countryCode: US' \
    --header 'accept: application/json' \
    --header 'name: action'

 * REFERENCES
 * 
	https://stackoverflow.com/questions/4064444/returning-json-from-a-php-script
    https://www.php.net/manual/en/reserved.variables.server.php
    https://stackoverflow.com/questions/1501274/get-array-of-rows-with-mysqli-result
	https://stackoverflow.com/questions/17407664/php-include-relative-path
	https://stackoverflow.com/questions/13577041/php-string-contains
	https://stackoverflow.com/questions/8321096/call-to-undefined-method-mysqli-stmtget-result
	https://stackoverflow.com/questions/1913899/mysqli-binding-params-using-call-user-func-array

*/


/*

// Example single script handling multiple endpoints:
    switch ($request) {
        case '/issue' :
            require __DIR__ . '/issue/default.php';
            break;
        case '/series' :
            require __DIR__ . '/series/default.php';
            break;
        case '/about' :
            require __DIR__ . '/about.php';
            break;
        default:
            http_response_code(404);
            require __DIR__ . './404.php';
            break;
    }

// 
./about
./about/announcements
./about/disclaimer
./about/howToHelp
./about/milestones
./about/navigation
./about/navigation/splashLinks
./about/navigation/usefulLinks
./about/social
./about/statistics
./about/volunteer
./about/{{default}}
./account
./account/profileLinks
./account/{{default}}
./award
./award/received
./award/received/{{id}}
./award/received/{{id}}/{{default}}
./award/{{id}}
./award/{{id}}/{{default}}
./calendar
./calendar/thumbnail
./calendar/timeline
./calendar/{{default}}
./character
./character/{{default}}
./creator
./creator/artInfluence
./creator/artInfluence/{{id}}
./creator/artInfluence/{{id}}/{{default}}
./creator/degree
./creator/degree/{{id}}
./creator/degree/{{id}}/{{default}}
./creator/membership
./creator/membership/{{id}}
./creator/membership/{{id}}/{{default}}
./creator/nonComicWork
./creator/nonComicWork/{{id}}
./creator/nonComicWork/{{id}}/{{default}}
./creator/portrait
./creator/portrait/{{id}}
./creator/portrait/{{id}}/{{default}}
./creator/relation
./creator/relation/{{id}}
./creator/relation/{{id}}/{{default}}
./creator/sampleScan
./creator/sampleScan/{{id}}
./creator/sampleScan/{{id}}/{{default}}
./creator/school
./creator/school/{{id}}
./creator/school/{{id}}/{{default}}
./creator/{{id}}
./creator/{{id}}/artInfluences
./creator/{{id}}/awards
./creator/{{id}}/degrees
./creator/{{id}}/links
./creator/{{id}}/memberships
./creator/{{id}}/names
./creator/{{id}}/nonComicWorks
./creator/{{id}}/relations
./creator/{{id}}/schools
./creator/{{id}}/{{default}}
./feature/{{id}}
./feature/{{default}}
./issue/dailyCovers
./issue/getWeekly
./issue/latest
./issue/{{id}}/brandEmblem
./issue/{{id}}/cache
./issue/{{id}}/colophonPublisher
./issue/{{id}}/editors
./issue/{{id}}/exportIssue
./issue/{{id}}/exportIssueCSV
./issue/{{id}}/keywords
./issue/{{id}}/nextIssue
./issue/{{id}}/previousIssue
./issue/{{id}}/publisher
./issue/{{id}}/relatedScans
./issue/{{id}}/series
./issue/{{id}}/stories
./issue/{{id}}/{{default}}
./my.comics
./my.comics/about
./my.comics/{{default}}
./publisher/{{id}}/brands
./publisher/{{id}}/brandUses
./publisher/{{id}}/indiciaPublishers
./publisher/{{id}}/numberofIssues
./publisher/{{id}}/numberOfSeries
./publisher/{{id}}/series
./search
./search/advanced
./search/new
./search/{{default}}
./series/{{id}}/covers
./series/{{id}}/coverStatus
./series/{{id}}/details
./series/{{id}}/details/timeline
./series/{{id}}/details/{{default}}
./series/{{id}}/indexedBy
./series/{{id}}/indexstatus
./series/{{id}}/lastModifiedBy
./series/{{id}}/tableOfContents
./wiki
./wiki/{{default}}

*/
?>
