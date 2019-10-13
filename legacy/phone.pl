#!/usr/bin/perl 
use warnings;
use strict;
# Perl script to generate Pastel transactions from the CSV version of the Phone usage report.
# Always change the accounting period (April is 1) and reading date, and make sure line endings are "CR,LF" before importing
my $accperiod = '06'; 
my $readingdate = '21/09/2019';
my $month = 'SEP';
#
my $ignored = 0;
my $read = 0;
my $selected = 0;
my %acc = ();
my %nam = ();
my @field;
my $value = '';
my $line = '';
my $cottage = '';
my $account = '';
my $ext = '';
my $pext = '';
my $pcost = 0;
my $name = '';
my $elec = '';
my $query = '';
my $tariff = 0;
my $dd = '';
my $mm = '';
my $yy = '';
my $sqm = 0;
my $opening = 0;
my $closing = 0;
my $used = 0;
my $nett = 0;
my $charge = 0;
my $totcharged = 0;
my $totused = 0;
my $pline = 'Settlers Park Finance Telephone Interface - V1';
my $ignore = 0;
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
#print "Timestamp = $timestamp\r\n";
#my $reportfile = 'PhoneCtl' . $timestamp . '.txt';
my $reportfile = 'PhoneCtl.txt';
#my $jnlfile = 'phone' . $timestamp . '.csv';
my $jnlfile = 'phone.txt';
for ($count = 0; $count < 10; $count++) {$field[$count] = '';}
open(my $ctlrep, '>', $reportfile) or die "$!, stopped";
open(my $jnlrep, '>', $jnlfile) or die "$!, stopped";
print $ctlrep "$pline - $timestamp\r\n";
open(LOOKUP,"SPLookup.txt") || die "Could not find LOOKUP file! $!, stopped";
while (defined($line = <LOOKUP>)) 
{
    $read += 1;
    chomp($line);  # Get rid of the end of line characters
    ($cottage, $account, $ext, $name, $elec, $query) = split /\t/, $line;
    if ($ext eq "" | $account eq ""){
		$ignored += 1;
		$value = $cottage;
		$value = $elec;
		$value = $name;
		$value = $query; 
  	   next; 
    }
    else {
    	$acc{$ext} = $account;
    	$name =~ s/^\s+//;	# Remove leading spaces
    	$name =~ s/#//g;		# Remove # from description
    	$name =~ s/\s+$//;	# Remove trailing spaces
    	$nam{$ext} = $name;
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
# Now read the phone report
while (defined($line = <STDIN>)) {
	$read += 1;
	@field = split(/\t/, $line);
	$value = defined($field[0]) ? $field[0] : "";
	if ($ignore == 1) {	# It will not be true
			$ignored += 1;		
	} 
	else {
		if ($value =~ /^\d+$/) {
		    $selected += 1;
			$pext = defined($field[0]) ? $field[0] : 0;
			$pext =~ s/\s+//g;
			if ($pext !~ /^\d+$/) {$error = 1; print $ctlrep "Extension number is not numeric $pext\r\n";}
			$pcost = defined($field[11]) ? $field[11] : 0;
			$pcost =~ s/^\s+//;
			$pcost =~ s/,/./;
			$pcost =~ s/\s+//g;
			if ($pcost !~ /^\d+.\d+$/) {$error = 1; print $ctlrep "Total cost is not numeric $pcost\r\n";}
			if ($error == 1) {
				$error = 0; 
				next;
			}
			$charge = $pcost;
			if (exists($acc{$pext})) {
				if ($acc{$pext} eq 'Calculate') {print $ctlrep "Post manually: $pext - $charge - $nam{$pext}\r\n"; $totcharged += $charge;}
				elsif ($acc{$pext} eq 'None') {
				#	print $ctlrep "Admin: $pext - $charge\r\n"; 
					$notcharged += $charge;
				}
				else {
				print $jnlrep "$accperiod,\"$readingdate\",\"D\",\"$acc{$pext}\",\"$month\",\"Phone calls x$pext\",$charge,\"02\",0,\" \",\"     \",\"9540010\",1,1,0,0,0,$charge\r\n";
				$totcharged += $charge;
				}
			} else {
				$ignored += 1;
				print $ctlrep "Extension $pext does not have an account code\r\n";
				$notcharged += $charge;		
			}
		}
		else {$ignored += 1;}
	}
}
print $ctlrep "\r\n";
print $ctlrep "Phone records Read     = $read\r\n";
print $ctlrep "Phone records Selected = $selected\r\n";
print $ctlrep "Phone records Ignored  = $ignored\r\n";
print $ctlrep "\r\n";
print $ctlrep "Total value of phone calls billed = $totcharged\r\n";
print $ctlrep "Total value NOT charged           = $notcharged\r\n";
print $ctlrep "\r\n";
print $ctlrep "--== End of control report ==--\r\n";
close ($ctlrep);
