<?php

$get_creator_relations_sql = "
    SELECT cr.id AS cr_id, cr.from_creator_id AS cr_from_creator_id, 
        c_fr.gcd_official_name AS c_fr_gcd_official_name, 
        rt.`type` AS cr_relation_type_type, cr.to_creator_id AS cr_to_creator_id, 
        c_to.gcd_official_name AS c_to_gcd_official_name,
        ( SELECT CAST( CONCAT('[', GROUP_CONCAT( json_object(
                'crcn_id',crcn.id, 'cnd_id', cnd.id, 'cnd_name', cnd.`name` ) ), ']') AS json )
            FROM " . $DBName . ".gcd_creator_relation_creator_name crcn
            INNER JOIN " . $DBName . ".gcd_creator_name_detail cnd ON cnd.id = crcn.creatornamedetail_id
            WHERE crcn.creatorrelation_id = cr.id ) AS using_names_json
    FROM " . $DBName . ".gcd_creator_relation cr
    INNER JOIN " . $DBName . ".gcd_relation_type rt ON rt.id = cr.relation_type_id
    LEFT JOIN " . $DBName . ".gcd_creator c_to ON c_to.id = cr.to_creator_id
    LEFT JOIN " . $DBName . ".gcd_creator c_fr ON c_fr.id = cr.from_creator_id
    WHERE cr.from_creator_id = ? "; // HAS JSON

$get_creator_by_name_paged_sql = "
    SELECT c.`id`, c.`gcd_official_name`, c.`birth_country_id`
    FROM " . $DBName . ".gcd_creator c
    INNER JOIN " . $DBName . ".gcd_story_credit sc ON sc.creator_id = c.id
    WHERE INSTR( `gcd_official_name`, ? ) > 0 
    GROUP BY  c.id
    ORDER BY COUNT(sc.creator_id) DESC
    LIMIT ?, ? ";

$get_indicia_printer_by_name_paged_sql = "
    SELECT `id`, `name`, `year_began`, `country_id`
    FROM " . $DBName . ".gcd_indicia_printer WHERE INSTR( `name`, ? ) > 0 
    ORDER BY `issue_count` DESC, `year_began`
    LIMIT ?, ? ";

$get_issue_indicia_printer_sql = "
    SELECT ip.`id`, ip.`name` FROM " . $DBName . ".gcd_issue_indicia_printer iip
    INNER JOIN " . $DBName . ".gcd_indicia_printer ip ON iip.`indiciaprinter_id` = ip.`id`
    WHERE iip.`issue_id` = ? ";

$get_issue_issue_reprints_sql = "
    SELECT ir.id, ir.origin_issue_id, ir.target_issue_id, ir.notes, ir.reserved,
        \"Parts of this issue are reprinted in another issue\" AS description_custom
    FROM " . $DBName . ".gcd_issue_reprint ir 
    WHERE ir.origin_issue_id = ?";

$get_issue_reprints_from_issue_sql = "
    SELECT rfi.id, rfi.origin_issue_id, stTo.issue_id AS to_issue, 
        rfi.target_id, rfi.notes, rfi.reserved,
        \"Parts of this issue are reprinted to a specific STORY\" AS description_custom
    FROM " . $DBName . ".gcd_reprint_from_issue rfi 
    INNER JOIN " . $DBName . ".gcd_story stTo ON stTo.id = rfi.target_id
    WHERE rfi.origin_issue_id = ?";

$get_issue_reprints_to_issue_sql = "
    SELECT rti.id, rti.origin_id, stFrom.issue_id AS from_issue, 
        rti.target_issue_id, rti.notes, rti.reserved,
        \"Parts of this issue are reprinted from a specific story\" AS description_custom
    FROM " . $DBName . ".gcd_reprint_to_issue rti 
    INNER JOIN " . $DBName . ".gcd_story stFrom ON stFrom.id = rti.origin_id
    WHERE rti.target_issue_id = ? ";
    
$get_printer_indicia_printers_sql = "
    SELECT ip.`id`, ip.`name` FROM " . $DBName . ".gcd_indicia_printer ip
    INNER JOIN " . $DBName . ".gcd_printer pr ON pr.`id` = ip.`parent_id`
    WHERE ip.`parent_id` = ? ";

$get_printer_by_name_paged_sql = "
    SELECT `id`, `name`, `year_began`, `country_id`
    FROM " . $DBName . ".gcd_printer WHERE INSTR( `name`, ? ) > 0 
    ORDER BY `issue_count` DESC, `year_began`
    LIMIT ?, ? ";

$get_publisher_brand_groups_sql = "
    SELECT * FROM " . $DBName . ".gcd_brand_group WHERE parent_id = ?";

$get_publisher_by_name_paged_sql = "
    SELECT `id`, `name`, `year_began`, `country_id`
    FROM " . $DBName . ".gcd_publisher WHERE INSTR( `name`, ? ) > 0 
    ORDER BY `series_count` DESC, `issue_count` DESC, `year_began`
    LIMIT ?, ?";

$get_series_by_name_paged_sql = "
    SELECT `id`, `name`, `year_began`, `publisher_id`, `country_id`
    FROM " . $DBName . ".gcd_series WHERE INSTR( `name`, ? ) > 0 
    ORDER BY `issue_count` DESC, `year_began`
    LIMIT ?, ?";

$get_series_brand_emblems_sql = "
    SELECT i.brand_id,
		IFNULL(b.`name`,\"no publisher's brand\") AS brand_name,
		count(i.brand_id) AS brand_issue_count
	FROM " . $DBName . ".gcd_series s
	INNER JOIN " . $DBName . ".gcd_issue i ON i.series_id = s.id
	LEFT JOIN " . $DBName . ".gcd_brand b ON b.id = i.brand_id
	WHERE s.id = ?
	GROUP BY i.brand_id
	ORDER BY b.year_began;";

$get_series_indicia_publishers_sql = "
    SELECT i.indicia_publisher_id, 
        IFNULL(ip.`name`,\"no publisher's brand\") AS indicia_publisher_name, 
        count(i.indicia_publisher_id) AS indicia_publisher_issue_count
    FROM " . $DBName . ".gcd_series s
    INNER JOIN " . $DBName . ".gcd_issue i ON i.series_id = s.id
    LEFT JOIN " . $DBName . ".gcd_indicia_publisher ip ON ip.id = i.indicia_publisher_id
    WHERE s.id = ?
    GROUP BY i.indicia_publisher_id
    ORDER BY ip.year_began;";

$get_series_awards_sql = "
    SELECT a.id as award_id,
        a.`name` as award_name, ra.id AS received_award_id,
        ra.`award_name` AS received_award_name, ra.award_year AS received_award_year    
    FROM " . $DBName . ".gcd_series s
    INNER JOIN " . $DBName . ".gcd_received_award ra ON ra.object_id = s.id
    INNER JOIN " . $DBName . ".gcd_award a ON a.id = ra.award_id
    WHERE s.id = ?
    GROUP BY s.id;";


$get_series_bonds_sql = "
    (SELECT sb.id, 
        sb.origin_id, CONCAT(series_from.name,' (',publisher_from.name,', ',series_from.year_began,' series)') AS origin_id_seriesname, 
        sb.target_id, CONCAT(series_to.name,' (',publisher_to.name,', ',series_to.year_began,' series)') AS target_id_seriesname, 
        sb.origin_issue_id, issue_from.number AS origin_issue_id_number, 
        sb.target_issue_id, issue_to.number AS target_issue_number, 
        sb.bond_type_id, 1 AS match_type_custom, 
        issue_to.sort_code AS sort_code_custom, 
        CONCAT('numbering continues with #', issue_to.number, ' from ', series_from.name, ' (', series_from.year_began, ' series) #', issue_from.number) AS bond_description_custom
    FROM " . $DBName . ".gcd_series_bond sb
    INNER JOIN " . $DBName . ".gcd_issue issue_to ON issue_to.id = sb.target_issue_id
    INNER JOIN " . $DBName . ".gcd_series series_to ON series_to.id = sb.target_id
    INNER JOIN " . $DBName . ".gcd_publisher publisher_to ON publisher_to.id = series_to.publisher_id
    INNER JOIN " . $DBName . ".gcd_issue issue_from ON issue_from.id = sb.origin_issue_id
    INNER JOIN " . $DBName . ".gcd_series series_from ON series_from.id = sb.origin_id
    INNER JOIN " . $DBName . ".gcd_publisher publisher_from ON publisher_from.id = series_from.publisher_id
    WHERE 
        sb.target_id = ?
    ) "; // end part 1 of 4

$get_series_bonds_sql .= " UNION
    (SELECT sb.id, 
        sb.origin_id, CONCAT(series_from.name,' (',publisher_from.name,', ',series_from.year_began,' series)') AS origin_id_seriesname, 
        sb.target_id, CONCAT(series_to.name,' (',publisher_to.name,', ',series_to.year_began,' series)') AS target_id_seriesname, 
        sb.origin_issue_id, issue_from.number AS origin_issue_id_number, 
        sb.target_issue_id, issue_to.number AS target_issue_number, 
        sb.bond_type_id, 2 AS match_type_custom,
        issue_from.sort_code AS sort_code_custom, 
        CONCAT('numbering continues after #', issue_from.number, ' with ', series_to.name, ' (', series_to.year_began, ' series) #', issue_to.number) AS bond_description_custom
    FROM " . $DBName . ".gcd_series_bond sb
    INNER JOIN " . $DBName . ".gcd_issue issue_to ON issue_to.id = sb.target_issue_id
    INNER JOIN " . $DBName . ".gcd_series series_to ON series_to.id = sb.target_id
    INNER JOIN " . $DBName . ".gcd_publisher publisher_to ON publisher_to.id = series_to.publisher_id
    INNER JOIN " . $DBName . ".gcd_issue issue_from ON issue_from.id = sb.origin_issue_id
    INNER JOIN " . $DBName . ".gcd_series series_from ON series_from.id = sb.origin_id
    INNER JOIN " . $DBName . ".gcd_publisher publisher_from ON publisher_from.id = series_from.publisher_id
    WHERE 
        sb.origin_id = ?
    ) "; // end part 2 of 4

$get_series_bonds_sql .= " UNION
    ( # ...and where there are SOME null issues
    SELECT sb.id, 
        sb.origin_id, CONCAT(series_from.name,' (',publisher_from.name,', ',series_from.year_began,' series)') AS origin_id_seriesname, 
        sb.target_id, CONCAT(series_to.name,' (',publisher_to.name,', ',series_to.year_began,' series)') AS target_id_seriesname, 
        sb.origin_issue_id, 'null' AS origin_issue_id_number, 
        sb.target_issue_id, 'null' AS target_issue_number, 
        sb.bond_type_id, 3 AS match_type_custom,
        'null' AS sort_code_custom, 
        CONCAT('numbering continues from ', series_from.name, ' (', series_from.year_began, ' series)') AS bond_description_custom
    FROM " . $DBName . ".gcd_series_bond sb
    INNER JOIN " . $DBName . ".gcd_series series_to ON series_to.id = sb.target_id
    INNER JOIN " . $DBName . ".gcd_publisher publisher_to ON publisher_to.id = series_to.publisher_id
    INNER JOIN " . $DBName . ".gcd_series series_from ON series_from.id = sb.origin_id
    INNER JOIN " . $DBName . ".gcd_publisher publisher_from ON publisher_from.id = series_from.publisher_id
    WHERE 
        ( sb.target_issue_id IS NULL 
            OR sb.origin_issue_id IS NULL ) 
        AND
        sb.target_id = ? 
    ) "; // end part 3 of 4

$get_series_bonds_sql .= " UNION
    ( # ...and where there are SOME null issues
    SELECT sb.id, 
        sb.origin_id, CONCAT(series_from.name,' (',publisher_from.name,', ',series_from.year_began,' series)') AS origin_id_seriesname, 
        sb.target_id, CONCAT(series_to.name,' (',publisher_to.name,', ',series_to.year_began,' series)') AS target_id_seriesname, 
        sb.origin_issue_id, 'null' AS origin_issue_id_number, 
        sb.target_issue_id, 'null' AS target_issue_number, 
        sb.bond_type_id, 4 AS match_type_custom,
        'null' AS sort_code_custom, 
        CONCAT('numbering continues with ', series_to.name, ' (', series_to.year_began, ' series)') AS bond_description_custom
    FROM " . $DBName . ".gcd_series_bond sb
    INNER JOIN " . $DBName . ".gcd_series series_to ON series_to.id = sb.target_id
    INNER JOIN " . $DBName . ".gcd_publisher publisher_to ON publisher_to.id = series_to.publisher_id
    INNER JOIN " . $DBName . ".gcd_series series_from ON series_from.id = sb.origin_id
    INNER JOIN " . $DBName . ".gcd_publisher publisher_from ON publisher_from.id = series_from.publisher_id
    WHERE 
        ( sb.target_issue_id IS NULL 
            OR sb.origin_issue_id IS NULL ) 
        AND
        sb.origin_id = ? 
    )
    ORDER BY sort_code_custom, match_type_custom;"; // end part 4 of 4

?>