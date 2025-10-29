<?php
class DashboardController extends BaseController {
    public function index($twig) {
        $tickets = loadTickets();
        
        $stats = [
            'total' => count($tickets),
            'open' => count(array_filter($tickets, function($t) { return $t['status'] === 'open'; })),
            'in_progress' => count(array_filter($tickets, function($t) { return $t['status'] === 'in_progress'; })),
            'closed' => count(array_filter($tickets, function($t) { return $t['status'] === 'closed'; }))
        ];
        
        $this->render($twig, 'dashboard.twig', [
            'stats' => $stats,
            'tickets' => $tickets
        ]);
    }
}
?>