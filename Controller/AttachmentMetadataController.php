<?php
App::uses("UrgPostAppController", "UrgPost.Controller");
class AttachmentMetadataController extends UrgPostAppController {

	var $name = 'AttachmentMetadata';

	function index() {
		$this->AttachmentMetadatum->recursive = 0;
		$this->set('attachmentMetadata', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid attachment metadatum'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('attachmentMetadatum', $this->AttachmentMetadatum->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->AttachmentMetadatum->create();
			if ($this->AttachmentMetadatum->save($this->data)) {
				$this->Session->setFlash(__('The attachment metadatum has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attachment metadatum could not be saved. Please, try again.'));
			}
		}
		$attachments = $this->AttachmentMetadatum->Attachment->find('list');
		$this->set(compact('attachments'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid attachment metadatum'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->AttachmentMetadatum->save($this->data)) {
				$this->Session->setFlash(__('The attachment metadatum has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The attachment metadatum could not be saved. Please, try again.'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->AttachmentMetadatum->read(null, $id);
		}
		$attachments = $this->AttachmentMetadatum->Attachment->find('list');
		$this->set(compact('attachments'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for attachment metadatum'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->AttachmentMetadatum->delete($id)) {
			$this->Session->setFlash(__('Attachment metadatum deleted'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Attachment metadatum was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
?>
