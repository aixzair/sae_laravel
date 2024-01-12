<?php 

namespace App\Http\Controllers;
use App\Models\formModel;

class formController 
{
    public function index()
    {
        $formModel = new formModel();

        // Tableau 1 Results
        $tableau1Results = $formModel->getTableau1Results('2024-04-01');

        // Tableau 2 Results
        $tableau2Results = $formModel->getTableau2Results('2024-04-01');

        // Tableau 3 Results
        $tableau3Results = $formModel->getTableau3Results(1, '2024-04-01');

        return view('generationPDF', compact('tableau1Results', 'tableau2Results', 'tableau3Results'));
    }
}
?>
