<?php
App::import("Lib", "Urg.AbstractWidgetComponent");

/**
 * The Post Content widget will add the content of the specified post within a view.
 *
 * Parameters: post_id The id of the post whose content is to be outputted.
 *             title   The title of the widget. Defaults to the post's title.
 */
class PostContentComponent extends AbstractWidgetComponent {
    function build_widget() {
        $post = $this->controller->Post->findById($this->widget_settings["post_id"]);
        CakeLog::write("debug", "post for post content widget: " . Debugger::exportVar($post, 3));
        $this->set("post", $post);
        $this->set("title", isset($this->widget_settings["title"]) ? 
                            $this->widget_settings["title"] : $post["Post"]["title"]);
        $this->set("id", isset($this->widget_settings["id"]) ?
                            $this->widget_settings["id"] : "post-content");
    }
}
