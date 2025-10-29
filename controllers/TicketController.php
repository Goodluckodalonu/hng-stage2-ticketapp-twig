<?php
class TicketController extends BaseController {
    public function index($twig) {
        $tickets = loadTickets();
        $editingId = $_GET['edit'] ?? null;
        $editingTicket = null;
        
        if ($editingId) {
            foreach ($tickets as $ticket) {
                if ($ticket['id'] == $editingId) {
                    $editingTicket = $ticket;
                    break;
                }
            }
        }
        
        $this->render($twig, 'tickets.twig', [
            'tickets' => $tickets,
            'editingTicket' => $editingTicket
        ]);
    }
    
    public function handlePost($twig) {
        $action = $_POST['action'] ?? 'create';
        $ticketId = $_POST['ticket_id'] ?? null;
        
        if ($action === 'create' || $action === 'update') {
            $this->saveTicket($twig, $ticketId);
        }
    }
    
    private function saveTicket($twig, $ticketId = null) {
        $title = $_POST['title'] ?? '';
        $status = $_POST['status'] ?? '';
        $description = $_POST['description'] ?? '';
        
        $errors = $this->validateTicketData([
            'title' => $title,
            'status' => $status
        ]);
        
        if (!empty($errors)) {
            showToast('Please fix the validation errors', 'error');
            $this->render($twig, 'tickets.twig', [
                'tickets' => loadTickets(),
                'errors' => $errors,
                'formData' => [
                    'title' => $title,
                    'status' => $status,
                    'description' => $description
                ]
            ]);
            return;
        }
        
        $tickets = loadTickets();
        $userId = $_SESSION['user']['id'];
        
        if ($ticketId) {
            // Update existing ticket
            foreach ($tickets as &$ticket) {
                if ($ticket['id'] == $ticketId) {
                    $ticket['title'] = $title;
                    $ticket['status'] = $status;
                    $ticket['description'] = $description;
                    $ticket['updatedAt'] = date('c');
                    break;
                }
            }
            $message = 'Ticket updated successfully!';
        } else {
            // Create new ticket
            $newTicket = [
                'id' => time(),
                'title' => $title,
                'status' => $status,
                'description' => $description,
                'userId' => $userId,
                'createdAt' => date('c'),
                'updatedAt' => date('c')
            ];
            $tickets[] = $newTicket;
            $message = 'Ticket created successfully!';
        }
        
        if (saveTickets($tickets)) {
            showToast($message, 'success');
            redirect('/tickets');
        } else {
            showToast('Failed to save ticket', 'error');
            $this->render($twig, 'tickets.twig', [
                'tickets' => $tickets,
                'formData' => [
                    'title' => $title,
                    'status' => $status,
                    'description' => $description
                ]
            ]);
        }
    }
    
    public function delete($twig) {
        $ticketId = $_POST['ticket_id'] ?? null;
        
        if (!$ticketId) {
            showToast('Ticket ID is required', 'error');
            redirect('/tickets');
        }
        
        $tickets = loadTickets();
        $initialCount = count($tickets);
        
        $tickets = array_filter($tickets, function($ticket) use ($ticketId) {
            return $ticket['id'] != $ticketId;
        });
        
        if (count($tickets) < $initialCount && saveTickets($tickets)) {
            showToast('Ticket deleted successfully!', 'success');
        } else {
            showToast('Failed to delete ticket', 'error');
        }
        
        redirect('/tickets');
    }
}
?>