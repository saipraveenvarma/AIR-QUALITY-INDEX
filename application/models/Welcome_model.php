<?php
class Welcome_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_last_weather_data() {
    $this->db->select_max('lastUpdate');
    $query = $this->db->get('current_aqi');
    $latestUpdate = $query->row()->lastUpdate;

    $this->db->where('lastUpdate', $latestUpdate);
    $query = $this->db->get('current_aqi');
    
    return $query->result();
    }

    public function get_last_6_hours_data() {
        $query = "
            WITH latest AS (
                SELECT MAX(\"lastUpdate\"::timestamp) AS latest_timestamp
                FROM public.current_aqi
            )
            SELECT DISTINCT ON (station, \"lastUpdate\"::timestamp)
                station,
                \"airQualityIndexValue\",
                \"lastUpdate\"::timestamp AS \"lastUpdate\"
            FROM
                public.current_aqi,
                latest
            WHERE
                \"lastUpdate\"::timestamp BETWEEN latest.latest_timestamp - INTERVAL '6 hours' AND latest.latest_timestamp
            ORDER BY
                station,
                \"lastUpdate\"::timestamp DESC;
        ";
    
        $result = $this->db->query($query);
    
        return $result->result_array();
    }


    public function get_last_week_data() {
        $query = "
            WITH latest AS (
                SELECT MAX(\"lastUpdate\"::timestamp) AS latest_timestamp
                FROM public.current_aqi
            )
            SELECT DISTINCT ON (station, \"lastUpdate\"::timestamp)
                station,
                \"airQualityIndexValue\",
                \"lastUpdate\"::timestamp AS \"lastUpdate\"
            FROM
                public.current_aqi,
                latest
            WHERE
                \"lastUpdate\"::timestamp BETWEEN latest.latest_timestamp - INTERVAL '2 hours' AND latest.latest_timestamp
            ORDER BY
                station,
                \"lastUpdate\"::timestamp DESC;
        ";
    
        $result = $this->db->query($query);
    
        return $result->result_array();
    }

    public function get_last_month_data() {
        $query = "
            WITH latest AS (
                SELECT MAX(\"lastUpdate\"::timestamp) AS latest_timestamp
                FROM public.current_aqi
            )
            SELECT DISTINCT ON (station, \"lastUpdate\"::timestamp)
                station,
                \"airQualityIndexValue\",
                \"lastUpdate\"::timestamp AS \"lastUpdate\"
            FROM
                public.current_aqi,
                latest
            WHERE
                \"lastUpdate\"::timestamp BETWEEN latest.latest_timestamp - INTERVAL '3 hours' AND latest.latest_timestamp
            ORDER BY
                station,
                \"lastUpdate\"::timestamp DESC;
        ";
    
        $result = $this->db->query($query);
    
        return $result->result_array();
    }
    
    
}
?>