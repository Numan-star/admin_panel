<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Calender extends CI_Controller
{
    public function index($y = null, $m = null)
    {
        // $prefs['template'] = array(
        //     'table_open'           => '<table class="calendar"  style="color:red;" border="1" cellpadding="4" cellspacing="2">',
        //     'cal_cell_start'       => '<td class="day">',
        //     'cal_cell_start_today' => '<td class="today">',
        //     'heading_previous_cell' => '<td><a href="{previous_url}">&lt;&lt;</a>',
        //     'heading_next_cell' => '<a href="{next_url}">&gt;&gt;</a>',
        //     'show_next_prev' => TRUE,
        //     'show_other_days' => TRUE

        // );

        // $prefs['template'] =
        //     '

        //         {table_open}<table style="color:red;" border="1" cellpadding="4" cellspacing="2">{/table_open}

        //         {heading_row_start}<tr>{/heading_row_start}

        //         {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
        //         {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
        //         {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

        //         {heading_row_end}</tr>{/heading_row_end}

        //         {week_row_start}<tr>{/week_row_start}
        //         {week_day_cell}<td>{week_day}</td>{/week_day_cell}
        //         {week_row_end}</tr>{/week_row_end}

        //         {cal_row_start}<tr>{/cal_row_start}
        //         {cal_cell_start}<td>{/cal_cell_start}
        //         {cal_cell_start_today}<td>{/cal_cell_start_today}
        //         {cal_cell_start_other}<td class="other-month">{/cal_cell_start_other}

        //         {cal_cell_content}<a href="{content}">{day}</a>{/cal_cell_content}
        //         {cal_cell_content_today}<div class="highlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}

        //         {cal_cell_no_content}{day}{/cal_cell_no_content}
        //         {cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}

        //         {cal_cell_blank}&nbsp;{/cal_cell_blank}

        //         {cal_cell_other}{day}{/cal_cel_other}

        //         {cal_cell_end}</td>{/cal_cell_end}
        //         {cal_cell_end_today}</td>{/cal_cell_end_today}
        //         {cal_cell_end_other}</td>{/cal_cell_end_other}
        //         {cal_row_end}</tr>{/cal_row_end}

        //         {table_close}</table>{/table_close}
        // ';

        // $prefs = array(
        //     'start_day'    => 'monday',
        //     'month_type'   => 'long',
        //     'day_type'     => 'short',
        //     'show_next_prev'  => TRUE,
        //     'show_other_days' => TRUE
        // );


        // $this->load->library('calendar', $prefs);
        // echo $this->calendar->generate();

        // $data = array(
        //     3  => 'http://example.com/news/article/2006/06/03/',
        //     7  => 'http://example.com/news/article/2006/06/07/',
        //     13 => 'http://example.com/news/article/2006/06/13/',
        //     26 => 'http://youtube.com'
        // );
        // echo $this->calendar->generate($y, $m);

        $data = array(
            'year' => $this->uri->segment(3),
            'month' => $this->uri->segment(4)
        );

        // Creating template for table
        $prefs['template'] = '
        {div_open}<div class="container">{/div_open}
            {table_open}<table cellpadding="1" cellspacing="2">{/table_open}
            
            {heading_row_start}<tr>{/heading_row_start}
            
            {heading_previous_cell}<th class="prev_sign"><a href="{previous_url}">&lt;</a></th>{/heading_previous_cell}
            {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
            {heading_next_cell}<th class="next_sign"><a href="{next_url}">&gt;</a></th>{/heading_next_cell}
            
            {heading_row_end}</tr>{/heading_row_end}
            
            //Deciding where to week row start
            {week_row_start}<tr class="week_name" >{/week_row_start}
            //Deciding  week day cell and  week days
            {week_day_cell}<td >{week_day}</td>{/week_day_cell}
            //week row end
            {week_row_end}</tr>{/week_row_end}
            
            {cal_row_start}<tr>{/cal_row_start}
            {cal_cell_start}<td>{/cal_cell_start}
            
            {cal_cell_content}<a href="{content}">{day}</a>{/cal_cell_content}
            {cal_cell_content_today}<div class="highlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}
            
            {cal_cell_no_content}{day}{/cal_cell_no_content}
            {cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}
            
            {cal_cell_blank}&nbsp;{/cal_cell_blank}
            
            {cal_cell_end}</td>{/cal_cell_end}
            {cal_row_end}</tr>{/cal_row_end}
            
            {table_close}</table>{/table_close}
            {div_close}</div>{/div_close}
            ';

        $prefs['day_type'] = 'short';
        $prefs['show_next_prev'] = TRUE;
        $prefs['show_other_days'] = TRUE;
        $prefs['next_prev_url'] = 'http://localhost/admin_panel/Calender/index';

        // Loading calendar library and configuring table template
        $this->load->library('calendar', $prefs);
        // Load view page
        $this->load->view('calender_show', $data);
    }
}
