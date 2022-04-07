<?php

function get_tabla($conn, $tabla){
    $sql = "SELECT * FROM " . strtolower($tabla);

    $res = safe_query($conn,$sql);

    $html_out = "";
    if ($res->num_rows > 0) {

        $html_out = "<div class=\"container text-center\">
        <h2>". $tabla ."</h2>

        <table class=\"table table-striped text-center align-middle\">
            <thead>
                <tr>
                <th scope=\"col\">#</th>
                <th scope=\"col\">Equipo 1</th>
                <th scope=\"col\">Equipo 2</th>
                <th scope=\"col\">Día</th>
                <th scope=\"col\">Hora</th>
                </tr>
            </thead>
            <tbody>
        ";
        
        while($row = $res->fetch_assoc()) {
            $id = $row[strtolower($tabla)."_id"];
            $eq1 = $row["eq1"]; $eq2 = $row["eq2"];
            $r1 = $row["r1"]; $r2 = $row["r2"];
            $date = strtotime($row["fecha"]);

            // Formateamos resultados
            list($r1,$r2) = formatearResultados($r1,$r2);

            $html_out = $html_out . "
            <tr>
                <th scope=\"row\" rowspan=\"2\">" . $id . "</th>" . 
                "<td><b>" . strtoupper($eq1) . "</b></td>" .
                "<td><b>" . strtoupper($eq2) . "</b></td>" .
                "<td rowspan=\"2\" class=\"fs-3\">" . spanishDay($date) . "</td>" .
                "<td rowspan=\"2\" class=\"fs-3\">" . date('H:i', $date) . "</td>" .
            "</tr>
            <tr>
                <td class=\"fs-1\">". $r1 ."</td>
                <td class=\"fs-1\">". $r2 ."</td>
            </tr>";
        }

        $html_out = $html_out . "</tbody></table></div>";

    } else {
      $html_out = "0 filas";
    }

    return $html_out;
}


function get_tabla_atletismo($conn, $categoria){
    $sql = "SELECT * FROM atletismo WHERE categoria='".$categoria."'";

    $res = safe_query($conn,$sql);

    $html_out = "";
    if ($res->num_rows > 0) {

        $html_out = "<div class=\"container text-center\">
        <h2>Atletismo ". $categoria ."</h2>

        <table class=\"table table-striped text-center align-middle\">
            <thead>
                <tr>
                <th scope=\"col\">#</th>
                <th scope=\"col\">Equipo</th>
                <th scope=\"col\">Posición</th>
                </tr>
            </thead>
            <tbody>
        ";
        $i = 1;
        while($row = $res->fetch_assoc()) {
            $eq = $row["eq"];
            $posicion = $row["posicion"];
            $categoria = $row["cate$categoria"];

            $html_out = $html_out . "
            <tr>
                <th scope=\"row\">" . $i . "</th>" . 
                "<td><b>" . strtoupper($eq) . "</b></td>" .
                "<td class=\"fs-3\"><b>" . $posicion . "</b></td>" .
            "</tr>";
            $i++;
        }

        $html_out = $html_out . "</tbody></table></div>";

    } else {
      $html_out = "0 filas";
    }

    return $html_out;
}

function get_modal_clasificacion($conn) {
	$sql = "SELECT * FROM clasificacion";
	$res = safe_query($conn,$sql);

    $html_out = "Error";
    if ($res->num_rows > 0) {
        $clasificaciones = [];
		while($row = $res->fetch_assoc()) {
            $clasif = [];
            $clasif["id"] = $row["clasificacion_id"];
			$clasif["eq"] = $row["eq"];
			$clasif["puntos"] = $row["puntos"];
            array_push($clasificaciones,$clasif);
		}

        // Reordeno el array
        $clasificaciones = array_sort($clasificaciones, "puntos", SORT_DESC);
        // Preparo el HTML
	    $html_out = "<ul class=\"list-group\">";
        $i = 0;
        foreach ($clasificaciones as &$clas) {
            $i++;
            if ($i == 1)
                $html_out = $html_out . "<li class=\"list-group-item list-group-item-action active\">".$i." - ".strtoupper($clas["eq"]). ": ". $clas["puntos"]." Puntos</li>";
            else
                $html_out = $html_out . "<li class=\"list-group-item list-group-item-action\">".$i." - ".strtoupper($clas["eq"]). ": ". $clas["puntos"]." Puntos</li>";

        }

        $html_out = $html_out . "</ul>";
	}
    return $html_out;
}



function get_tabla_editable($conn, $tabla){
    $sql = "SELECT * FROM " . strtolower($tabla);

    $res = safe_query($conn,$sql);

    $html_out = "";
    if ($res->num_rows > 0) {

        $html_out = "<div class=\"container text-center\">
        <h2>". $tabla ."</h2>

        <table class=\"table table-striped text-center align-middle\">
            <thead>
                <tr>
                <th scope=\"col\">#</th>
                <th scope=\"col\">Equipo 1</th>
                <th scope=\"col\">Equipo 2</th>
                <th scope=\"col\">Día</th>
                <th scope=\"col\">Hora</th>
                </tr>
            </thead>
            <tbody>
        ";
        
        while($row = $res->fetch_assoc()) {
            $id = $row[strtolower($tabla)."_id"];
            $eq1 = $row["eq1"]; $eq2 = $row["eq2"];
            $r1 = $row["r1"]; $r2 = $row["r2"];
            $date = strtotime($row["fecha"]);


            $html_out = $html_out . "
            <tr>
                <th scope=\"row\" rowspan=\"2\">" . $id . "</th>" . 
                "<td><b>" . strtoupper($eq1) . "</b></td>" .
                "<td><b>" . strtoupper($eq2) . "</b></td>" .
                "<td rowspan=\"2\" class=\"fs-3\">" . spanishDay($date) . "</td>" .
                "<td rowspan=\"2\" class=\"fs-3\">" . date('H:i', $date) . "</td>" .
            "</tr>
            <tr>
                <td class=\"fs-1\"><input type=\"number\" name=\"r1_". $id ."_".strtolower($tabla)."\" id=\"r1_". $id ."\" class=\"form-control\" value=". $r1 ."></td>
                <td class=\"fs-1\"><input type=\"number\" name=\"r2_". $id ."_".strtolower($tabla)."\" id=\"r2_". $id ."\" class=\"form-control\" value=". $r2 ."></td>
            </tr>";
        }

        $html_out = $html_out . "</tbody></table></div>";

    } else {
      $html_out = "0 filas";
    }

    return $html_out;
}


function get_tabla_atletismo_editable($conn, $categoria){
    $factor = 0;
    if (strcmp($categoria,'100m') === 0)
        $factor = 1;
    elseif (strcmp($categoria,'200m') === 0)
        $factor = 2;
    else
        $factor = 3;

    $sql = "SELECT * FROM atletismo WHERE categoria='".$categoria."'";

    $res = safe_query($conn,$sql);

    $html_out = "";
    if ($res->num_rows > 0) {

        $html_out = "<div class=\"container text-center\">
        <h2>Atletismo ". $categoria ."</h2>

        <table class=\"table table-striped text-center align-middle\">
            <thead>
                <tr>
                <th scope=\"col\">#</th>
                <th scope=\"col\">Equipo</th>
                <th scope=\"col\">Posición</th>
                </tr>
            </thead>
            <tbody>
        ";
        $i = 1;
        while($row = $res->fetch_assoc()) {
            $id = $row["atletismo_id"];
            $eq = $row["eq"];
            $posicion = $row["posicion"];
            $categoria = $row["cate$categoria"];

            $html_out = $html_out . "
            <tr>
                <th scope=\"row\">" . $i . "</th>" . 
                "<td><b>" . strtoupper($eq) . "</b></td>" .
                "<td class=\"fs-3\"><b><input type=\"number\" name=\"posicion_".$id."\" id=\"posicion_".$id."\" class=\"form-control\" value=\"".$posicion."\"</b></td>" .
            "</tr>";
            $i++;
        }

        $html_out = $html_out . "</tbody></table></div>";

    } else {
      $html_out = "0 filas";
    }

    return $html_out;
}



function get_modal_clasificacion_editable($conn) {
	$sql = "SELECT * FROM clasificacion";
	$res = safe_query($conn,$sql);

    $html_out = "Error";
    if ($res->num_rows > 0) {
        $clasificaciones = [];
		while($row = $res->fetch_assoc()) {
            $clasif = [];
            $clasif["id"] = $row["clasificacion_id"];
			$clasif["eq"] = $row["eq"];
			$clasif["puntos"] = $row["puntos"];
            array_push($clasificaciones,$clasif);
		}

        // Reordeno el array
        $clasificaciones = array_sort($clasificaciones, "puntos", SORT_DESC);
        // Preparo el HTML
	    $html_out = "<ul class=\"list-group\">";
        $i = 0;
        foreach ($clasificaciones as &$clas) {
            $i++;
            $html_out = $html_out . "<li class=\"list-group-item list-group-item-action\">".$i." - ".strtoupper($clas["eq"]). ": ".
            "<input type=\"number\" name=\"puntos_".$clas["id"]."\" id=\"puntos_".$clas["id"]."\" class=\"form-control\" value=\"".$clas["puntos"]."\">"
            ." Puntos</li>";

        }

        $html_out = $html_out . "</ul>";
	}
    return $html_out;
}

?>