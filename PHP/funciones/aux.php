<?php 

function spanishDay($FechaStamp)
{
   $diasemana = date('w',$FechaStamp);
   $diassemanaN= array("Domingo","Lunes","Martes","Miércoles",
                  "Jueves","Viernes","Sábado");
   return $diassemanaN[$diasemana];
}


function formatearResultados($r1,$r2) {
    if ($r1 < $r2) {
        // Equipo 1 ha perdido -> rojo, Equipo 2 ha ganado -> verde
        $r1 = "<div class=\"text-danger\">" . $r1 . "</div>";
        $r2 = "<div class=\"text-success\">" . $r2 . "</div>";
    } elseif ($r1 > $r2) {
        $r1 = "<div class=\"text-success\">" . $r1 . "</div>";
        $r2 = "<div class=\"text-danger\">" . $r2 . "</div>";
    }
    
    return array($r1,$r2);
}

// Recorre todos los datos del formulario y los contrasta
// con la base de datos para saber si ha habido actualizaciones
// Devuelve un array de arrays con los ids por deporte que han sido modificados
function get_updates() {

    $updates = array();

    $conn = connect_database();
    
    // Voleym, Basket, Futsal
    $tablas = array('Voley', 'Basket', 'Futsal');
    foreach ($tablas as &$tabla) {
        $vector_id = [];

        $sql = "SELECT * FROM " . strtolower($tabla);
        $res = safe_query($conn,$sql);
        
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $tmp = [];
                // Datos BD
                $id = $row[strtolower($tabla).'_id'];
                $r1 = $row['r1'];
                $r2 = $row['r2'];

                // Datos formulario
                $r1_form = $_POST['r1_'.$id.'_'.strtolower($tabla)];
                $r2_form = $_POST['r2_'.$id.'_'.strtolower($tabla)];

                // Si no son iguales, me lo apunto para actualizar
                if ($r1 != $r1_form or $r2 != $r2_form) {
                    $tmp['id'] = $id;
                    $tmp['r1'] = $r1_form;
                    $tmp['r2'] = $r2_form;
                    array_push($vector_id,$tmp);

                }
            }
        }
        $updates[strtolower($tabla)] = $vector_id;
    }

    // Atletismo
    $categorias = array('100m', '200m', '400m');
    foreach ($categorias as &$cat) {
        $vector_id = [];

        $sql = "SELECT * FROM atletismo WHERE categoria='". $cat ."'";
        $res = safe_query($conn,$sql);
    
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $tmp = [];
                // Datos BD
                $id = $row['atletismo_id'];
                $posicion = $row['posicion'];

                // Datos formulario
                $posicion_form = $_POST['posicion_'.$id];

                // Si no son iguales, me lo apunto para actualizar
                if ($posicion != $posicion_form) {
                    $tmp['id'] = $id;
                    $tmp['posicion'] = $posicion_form;
                    array_push($vector_id,$tmp);
                }
            }
        }
        $updates[$cat] = $vector_id;
    }

    // Clasificacin
    $vector_id = [];

    $sql = "SELECT * FROM clasificacion";
    $res = safe_query($conn,$sql);

    if ($res->num_rows > 0) {
        while($row = $res->fetch_assoc()) {
            $tmp = [];
            // Datos BD
            $id = $row['clasificacion_id'];
            $puntos = $row['puntos'];

            // Datos formulario
            $puntos_form = $_POST['puntos_'.$id];

            // Si no son iguales, me lo apunto para actualizar
            if ($puntos != $puntos_form) {
                $tmp['id'] = $id;
                $tmp['puntos'] = $puntos_form;
                array_push($vector_id,$tmp);
            }
        }
    }
    $updates["clasificacion"] = $vector_id;

    $conn->close();
    return $updates;
}


function update_tablas($updates) {
    $conn = connect_database('updateonly');

    // Deportes
    $tablas = array('voley','basket','futsal');
    foreach($tablas as &$tabla) {
        $u_tabla = $updates[$tabla];

        if (sizeof($u_tabla) > 0) {
            foreach ($u_tabla as &$u_fila) {
                $id = $u_fila["id"];
                $r1 = $u_fila["r1"];
                $r2 = $u_fila["r2"];

                $sql = "UPDATE ".$tabla." SET r1=".$r1.", r2=".$r2." WHERE ".$tabla."_id=".$id;
                safe_query($conn, $sql);

            }
        }
    }

    // Atletismo
    $categorias = array('100m', '200m', '400m');
    foreach($categorias as &$cat) {
        $u_cat = $updates[$cat];

        if (sizeof($u_cat) > 0) {
            foreach ($u_cat as &$u_c) {
                $id = $u_c["id"];
                $posicion = $u_c["posicion"];

                $sql = "UPDATE atletismo SET posicion='".$posicion."' WHERE atletismo_id=".$id;
                safe_query($conn, $sql);

            }
        }
    }

    // Clasificacion
    $u_clasif = $updates["clasificacion"];

        if (sizeof($u_clasif) > 0) {
            foreach ($u_clasif as &$u_c) {
                $id = $u_c["id"];
                $puntos = $u_c["puntos"];

                $sql = "UPDATE clasificacion SET puntos='".$puntos."' WHERE clasificacion_id=".$id;
                safe_query($conn, $sql);

            }
        }

    $conn->close();

}

function array_sort($array, $on, $order=SORT_ASC) {
    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
            break;
            case SORT_DESC:
                arsort($sortable_array);
            break;
        }

        // print_r($sortable_array);

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}


?>