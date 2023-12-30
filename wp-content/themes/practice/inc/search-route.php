<?php
// http://localhost/wp-practice/wp-json/practice/v1/search
add_action('rest_api_init', 'themeRegisterSearch');

function themeRegisterSearch(){
    register_rest_route('practice/v1', 'search', array(
        'method' => WP_REST_SERVER::READABLE,
        'callback' => 'themeSearchResults'
    ));
}

function themeSearchResults($data){
    $mainQuery = new WP_Query(array(
        'post_type' => array('post', 'page', 'professor', 'program', 'campus', 'event'),
        's' => sanitize_text_field($data['term'])
    ));

    $results = array(
        'generalInfo' => array(),
        'professors' => array(),
        'programs' => array(),
        'events' => array(),
        'campuses' => array(),
    );
    
    while($mainQuery->have_posts()){
        $mainQuery->the_post();
        if(get_post_type() == 'post' OR get_post_type() == 'page'){
            array_push($results['generalInfo'], array(
                'title' => get_the_title(),
                'permalink' => get_permalink(),
            )); 
        }

        if(get_post_type() == 'professor'){
            array_push($results['professors'], array(
                'title' => get_the_title(),
                'permalink' => get_permalink(),
            )); 
        }

        if(get_post_type() == 'program'){
            array_push($results['programs'], array(
                'title' => get_the_title(),
                'permalink' => get_permalink(),
            )); 
        }

        if(get_post_type() == 'campus'){
            array_push($results['campuses'], array(
                'title' => get_the_title(),
                'permalink' => get_permalink(),
            )); 
        }

        if(get_post_type() == 'event'){
            array_push($results['events'], array(
                'title' => get_the_title(),
                'permalink' => get_permalink(),
            )); 
        }
        
    }

    return $results;

}