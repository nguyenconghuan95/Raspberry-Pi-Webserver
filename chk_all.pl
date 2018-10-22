#!/usr/bin/perl

my $log = "./log/Proof_detailed.log";

use lib "./lib";
use Spreadsheet::ParseExcel;
use Spreadsheet::ParseExcel::SaveParser;
use Spreadsheet::WriteExcel;

my $parser = new Spreadsheet::ParseExcel::SaveParser;
my $template = $parser -> Parse('cv_chklist.xls');
my $sheet = $template -> worksheet(0);

my $row = 0;
my $col = 0;

for ($row = 0; $row < 2; $row = $row +1) {
  my $sig_name = $sheet -> get_cell($row,$col) -> value();
  my $bit_nu = $sheet -> get_cell($row,$col+1) -> value();
  my $expect_up = $sheet -> get_cell($row,$col+2) -> value();
  my $expect_fall = $sheet -> get_cell($row,$col+3) -> value();

  my $full_sig_name = "$sig_name\[$bit_nu\]";
  open(LOG_FILE, "<$log");
  my $first_ln = 0;
  while(my $line = <LOG_FILE>) {
    if ($first_ln != 0) {
      $first_ln = $first_ln + 1;
      if ($first_ln == 2) {
        my $checker_arr = split('_', $_);
        my $checker = $checker_arr[3];
      }
      if ($first_ln == 5) {
        $first_ln = 0;
        my $result_arr = split(':', $_);
        my $result = $result_arr[1];
        if ($checker =~ /rise/) {
          if (($result =~ /covered/) && ($expect_up =~ /Yes/)) {
            AddCell($row,$col+4,'PASS');
          }
          else {
            AddCell($row,$col+4,'FAIL');
          }
        }
        elsif ($checker =~ /fall/) {
          if (($result =~ /covered/) && ($expect_fall =~ /Yes/)) {
            AddCell($row,$col+4,'PASS');
          }
          else {
            AddCell($row,$col+4,'FAIL');
          }
        }
      }
    }
    if ($_ =~ /$full_sig_name/) {
      my $first_ln = 1;
    }
  }
}

