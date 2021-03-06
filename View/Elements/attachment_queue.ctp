<?php
$contents = "";
if (isset($attachments)) {
    $counter = 0;
    foreach ($attachments as $attachment) {
        $filename = $attachment["Attachment"]["filename"];
        $link = $this->Html->link(substr($filename, 0, 40), "/urg_post/" . 
                $this->requestAction("/urg_post/posts/get_webroot_folder/$filename") . 
                "/$post_id/$filename", array("id"=>"ExistingAttachmentQueueLink$counter"));
        $link .= $this->Html->link(
                $this->Html->image("/img/icons/x.png", array("style"=>"height: 16px; float: right")),
                $this->Html->url("/urg_post/posts/delete_attachment/" . 
                        $attachment["Attachment"]["id"]),
                array("escape" => false, 
                      "class" => "delete-attachment-link",
                      "id" => "DeleteLink$counter")
        );
        $contents .= $this->Html->tag("li", $link, 
                array("id"=>"ExistingAttachmentQueueListItem" . $counter));

        $counter++;
    }
}
echo $this->Html->div("", $this->Html->tag("ul", $contents, array("id"=>"attachment-queue")));
