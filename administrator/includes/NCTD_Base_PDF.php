<?php
require_once('fpdf/fpdf.php');

class NCTD_Base_PDF extends FPDF {
    protected $extgstates = array();

    function SetAlpha($alpha, $bm='Normal') {
        $gs = $this->AddExtGState(array('ca'=>$alpha, 'CA'=>$alpha, 'BM'=>'/'.$bm));
        $this->_out(sprintf('/GS%d gs', $gs));
    }

    function AddExtGState($parms) {
        $n = count($this->extgstates) + 1;
        $this->extgstates[$n]['parms'] = $parms;
        return $n;
    }

    function _putextgstates() {
        // Fix: Use foreach to avoid index mismatches that trigger "Invalid Call"
        foreach ($this->extgstates as $i => $state) {
            $this->_newobj();
            $this->extgstates[$i]['n'] = $this->n;
            $this->_out('<</Type /ExtGState');
            foreach ($state['parms'] as $k => $v) {
                $this->_out('/' . $k . ' ' . $v);
            }
            $this->_out('>>');
            $this->_out('endobj');
        }
    }

    function _putresourcedict() {
        parent::_putresourcedict();
        if (count($this->extgstates) > 0) {
            $this->_out('/ExtGState <<');
            foreach ($this->extgstates as $k => $v) {
                $this->_out('/GS' . $k . ' ' . $v['n'] . ' 0 R');
            }
            $this->_out('>>');
        }
    }

    function _putresources() {
        $this->_putextgstates();
        parent::_putresources();
    }

    function RotatedText($x, $y, $txt, $angle) {
        $angle = $angle * M_PI / 180;
        $c = cos($angle); $s = sin($angle);
        $cx = $x * $this->k; $cy = ($this->h - $y) * $this->k;
        $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm BT /F1 %.2F Tf (%s) Tj ET Q', 
            $c, $s, -$s, $c, $cx, $cy, $this->FontSizePt, $this->_escape($txt)));
    }
}