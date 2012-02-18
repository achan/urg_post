<?php
App::uses("AbstractWidgetHelper", "Urg.Lib");
class UpcomingEventsHelper extends AbstractWidgetHelper {
    var $helpers = array("Html", "Time");

    function build_widget() {
        $this->Html->css("/urg_post/css/urg_post.css", null, array("inline"=>false));
        $title = $this->Html->tag("h2", __("Upcoming Events"));
        return $this->Html->div("upcoming-events", 
                                $title . $this->add_post() . $this->upcoming_activity($this->options["upcoming_events"]));
    }

    function add_post() {
        $link = "";
        if ($this->options["can_add"]) {
            $link = $this->Html->link(__("Add an upcoming event..."), array("plugin" => "urg_post",
                                                                                     "controller" => "posts",
                                                                                     "action" => "add",
                                                                                     $this->options["upcoming_group"]["Group"]["slug"]));
        }
        return $link;
    }

    function upcoming_activity($posts) {
        $upcoming_events = "";

        if (sizeof($posts) > 0) {
            foreach ($posts as $post) {
                $time = $this->Html->div("upcoming-timestamp",
                        $this->Time->format("F j, Y @ g:i A", $post["Post"]["publish_timestamp"]));
                $title = $this->Html->div("upcoming-title", $post["Post"]["title"]);
                $details = $this->Html->div("upcoming-details", $post["Post"]["content"]);
                $upcoming_events .= $this->Html->tag("li", $time . $title . $details);
            }
        } else {
            $upcoming_events = $this->Html->tag("li", __("No upcoming events."));
        }

        return $this->Html->tag("ul", $upcoming_events, array("id" => "upcoming-events"));
    }
}
