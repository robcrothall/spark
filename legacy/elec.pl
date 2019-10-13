#!/usr/bin/perl 
use warnings;
use strict;
# Perl script to generate Pastel transactions from the CSV version of the Electricity usage report.
# Always change the accounting period (April is 1), and make sure line endings are "CR,LF" before importing
my $accperiod = '06'; 
#
my $ignored = 0;
my $read = 0;
my $selected = 0;
my %el_acc = ();
my @field;
my $value = '';
my $line = '';
my $cottage = '';
my $account = '';
my $ext = '';
my $name = '';
my $elec = '';
my $query = '';
my $tariff = 0;
my $dd = '';
my $mm = '';
my $yy = '';
my $readingdate = '';
my $sqm = 0;
my $opening = 0;
my $closing = 0;
my $used = 0;
my $nett = 0;
my $charge = 0;
my $totcharged = 0;
my $totused = 0;
my $pline = 'Settlers Park Finance Electricity Interface';
my $ignore = 1;
my $error = 0;
my $count = 0;
my $calculate = 0;
my $notcharged = 0;
my $rebate = 0;
my ($sec,$min,$hour,$mday,$mon,$year,$wday,$yday,$isdst) = localtime(time);
$year += 1900;
my $month = sprintf("%02d",$mon + 1);
$mday = sprintf("%02d",$mday);
$hour = sprintf("%02d",$hour);
$min = sprintf("%02d",$min);
$sec = sprintf("%02d",$sec);
my $timestamp = $year . $month . $mday . $hour . $min . $sec;
#print "Timestamp = $timestamp\n";
#my $reportfile = 'ElecCtl' . $timestamp . '.txt';
my $reportfile = 'ElecCtl.txt';
#my $jnlfile = 'Elec' . $timestamp . '.csv';
my $jnlfile = 'elec.csv';
for ($count = 0; $count < 10; $count++) {$field[$count] = '';}
open(my $ctlrep, '>', $reportfile) or die "$!, stopped";
open(my $jnlrep, '>', $jnlfile) or die "$!, stopped";
print $ctlrep "$pline\r\n";
open(LOOKUP,"SPLookup.txt") || die "Could not find LOOKUP file! $!, stopped";
while (defined($line = <LOOKUP>)) 
{
	$read += 1;
	chomp($line);
	($cottage, $account, $ext, $name, $elec, $query) = split /\t/, $line;
	if ($elec eq "" | $account eq ""){
		$ignored += 1;
		$value = $cottage;
		$value = $ext;
		$value = $name;
		$value = $query; 
  	next; 
	}
	else {
	    $el_acc{$elec} = $account;
	    $selected += 1;
	}
}
close(LOOKUP);
print $ctlrep "\r\n";
print $ctlrep "Lookup Records Read     = $read\r\n";
print $ctlrep "Lookup Records Selected = $selected\r\n";
print $ctlrep "Lookup Records Ignored  = $ignored\r\n";
print $ctlrep "\r\n";
$read = 0;
$selected = 0;
$ignored = 0;
while (defined($line = <STDIN>)) {
	$read += 1;
	@field = split(/\t/, $line);
	$value = defined($field[2]) ? $field[2] : "";
	if ($ignore == 1) {
		if ($value eq 'Date read:') {
			$ignore = 0;
			$tariff = $field[8];
			$tariff =~ s/R\s+//;
			$tariff =~ s/,/./;
			$tariff =~ s/\s+//g;
			if ($tariff !~ /^\d+.\d+$/) {$error = 1; print $ctlrep "Tariff is not numeric $tariff\n";}
			print $ctlrep "Tariff = $tariff per unit\r\n";
		} elsif ($value eq 'Settlers Park Electricity Meter Readings') {
			($yy, $mm, $dd) = split('/',$field[7]);
			$readingdate = $dd . '/' . $mm . '/' . $yy;
			print $ctlrep "Meter Reading Date = $readingdate\r\n";		
		} else {
			$ignored += 1;		
		}
	} else {
		if ($value ne '') {
			$selected += 1;
			$cottage = $field[2];
			$sqm = $field[3];
			if ($sqm eq '') {$sqm = 0;}
			if ($sqm !~ /^\d+$/) {$error = 1; print $ctlrep "Cottage: $cottage - Size of cottage is not numeric $sqm\r\n"; $sqm = 0;}
			$opening = $field[4];
			$opening =~ s/\s+//g;
			if ($opening !~ /^\d+$/) {$error = 1; print $ctlrep "Cottage: $cottage - Opening reading not numeric $opening\r\n";}
			$closing = $field[5];
			$closing =~ s/\s+//g;
			if ($closing !~ /^\d+$/) {$error = 1; print $ctlrep "Cottage: $cottage - Closing reading not numeric $closing\r\n";}
			if ($error == 1) {
				$error = 0; 
				next;
			}
			$used = $closing - $opening;
			$nett = $used;
			$charge = 0;
			if ($used > $sqm) {
				$nett = $used - $sqm;
				$charge = $nett * $tariff;
				$rebate += $sqm * $tariff;
			} else {$rebate += $used * $tariff;}
			$totused += $used;
			if (exists($el_acc{$cottage})) {
				if ($el_acc{$cottage} eq "Calculate") {
					$calculate += $charge;
					print $ctlrep "Prepare manual transaction: ID = $cottage, Opening = $opening, Closing = $closing, Rebate = $sqm, Usage = $nett @ $tariff = $charge\r\n";
					$totcharged += $charge;
				} elsif ($el_acc{$cottage} eq "None") {
					print $ctlrep "Not charged:                ID = $cottage, Opening = $opening, Closing = $closing, Rebate = $sqm, Usage = $nett @ $tariff = $charge\r\n";
					$notcharged += $charge;
				} elsif ($charge > 0) {
					print $jnlrep "$accperiod,\"$readingdate\",\"D\",\"$el_acc{$cottage}\",\"ELEC\",\"Previous Meter Reading $opening\",0,\"00\",0,\" \",\"     \",\"0\",1,1,0,0,0,0\r\n";
					print $jnlrep "$accperiod,\"$readingdate\",\"D\",\"$el_acc{$cottage}\",\"ELEC\",\"Current  Meter Reading $closing\",0,\"00\",0,\" \",\"     \",\"0\",1,1,0,0,0,0\r\n";
					print $jnlrep "$accperiod,\"$readingdate\",\"D\",\"$el_acc{$cottage}\",\"ELEC\",\"Less allowance $sqm units\",0,\"00\",0,\" \",\"     \",\"0\",1,1,0,0,0,0\r\n";
					print $jnlrep "$accperiod,\"$readingdate\",\"D\",\"$el_acc{$cottage}\",\"ELEC\",\"Chargeable usage $nett @ $tariff\",$charge,\"02\",0,\" \",\"     \",\"9500010\",1,1,0,0,0,$charge\r\n";
					$totcharged += $charge;
				} else {
					print $ctlrep "Zero value:                 ID = $cottage, Opening = $opening, Closing = $closing, Rebate = $sqm, Usage = $nett @ $tariff = $charge\r\n";
					$ignored += 1;
				}
			} else {
				$ignored += 1;
				print $ctlrep "Meter for $cottage does not have an account code\r\n";			
			}
		}
		else {$ignored += 1;}
	}
}
print $ctlrep "\n";
print $ctlrep "Electricity records Read     = $read\r\n";
print $ctlrep "Electricity records Selected = $selected\r\n";
print $ctlrep "Electricity records Ignored  = $ignored\r\n";
print $ctlrep "\r\n";
$charge = $totused * $tariff;
print $ctlrep "Total value charged, after rebates and including manual charges = $totcharged\r\n";
print $ctlrep "This should balance to the Control account 9500010\r\n\r\n";
print $ctlrep "Total value of electricity used - $totused units @ $tariff            = $charge\r\n";
print $ctlrep "This should balance to the Municipal account\r\n\r\n";
print $ctlrep "Total value of rebates                                          = $rebate\r\n\r\n";
print $ctlrep "Total value of manual invoices                                  = $calculate\r\n";
print $ctlrep "This should balance to the manual batch total\r\n\r\n";
print $ctlrep "Total value NOT charged i.e. Admin overhead                     = $notcharged\r\n";
print $ctlrep "\r\n";
print $ctlrep "--== End of control report ==--\r\n";
close ($ctlrep);
