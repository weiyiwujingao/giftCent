<?php

namespace Helper;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class OfiiceHelper
{
	public function __construct()
	{

	}

	/***
	 * 导出表格数据
	 * @author: colin
	 * @date: 2018/12/12 17:42
	 * @param $titles
	 * @param $dataArr
	 * @param string $filename
	 * @param bool $url
	 * @return string
	 * @throws \PhpOffice\PhpSpreadsheet\Exception
	 * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
	 */
	public static function exportExcelOne($titles,$dataArr,$filename='export',$titleNote='',$url=false)
	{
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$spreadsheet->setActiveSheetIndex(0);
		$spreadsheet->getActiveSheet()->setTitle('infos');

		$azs = range('A','Z');

		// 写入表格数据
		$i = 0;$add = 0;
		if($titleNote){
			$add = 1;
			$sheet->setCellValue(($azs[$i]).'1', $titleNote);
			$prange = ($azs[$i]).(1).':'.($azs[$i+6]).(1);
			$sheet->mergeCells($prange);
		}
		foreach ($titles as $key => $title) {
			$start = 1+$add;
			$sheet->setCellValue(($azs[$i]).$start, $title);
			foreach ($dataArr[$key] as $n => $val) {
				$sheet->setCellValue(($azs[$i]).($n+2+$add), $val);
			}
			++$i;
		}

		$filename = $filename."_".date('Y-m-d').".xlsx";

		header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");//告诉浏览器输出07Excel文件
		header("Content-Disposition: attachment;filename=".$filename);//告诉浏览器输出浏览器名称
		$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

		if($url){
			//创建导出目录
			$disPath = PUBLIC_PATH."upload/export/";

			if(!is_dir($disPath)){
				\Helper\CFunctionHelper::createFolder($disPath);
			}
			$filePath = $disPath.$filename;

			$writer->save($filePath);
		}else{
			$writer->save('php://output');
		}

		//释放内存
		$spreadsheet->disconnectWorksheets();
		unset($spreadsheet);

		return $filename;
	}
	/***
	 * 导出表格-可以多sheet附属表
	 * @author: colin
	 * @date: 2018/12/12 17:39
	 * @param $titles
	 * @param $dataArr
	 * @param string $filename
	 * @param array $tabletwo
	 * @return string
	 */
	public static function exportExcel($titles,$dataArr,$filename='export',$tabletwo = [],$pran = 'order_sn')
	{
		try{
			$spreadsheet = new Spreadsheet();
			$sheet = $spreadsheet->getActiveSheet();
			$spreadsheet->setActiveSheetIndex(0);
			$spreadsheet->getActiveSheet()->setTitle($filename);

			$azs = range('A','Z');
			// 写入表格数据
			$i = 0;
			foreach ($titles as $key => $title) {
				$sheet->setCellValue(($azs[$i]).'1', $title);
				foreach ($dataArr[$key] as $n => $val) {
					$sheet->setCellValue(($azs[$i]).($n+2), $val);
				}
				++$i;
			}
			if(!empty($tabletwo)){
				foreach($tabletwo as $k => $item){
				    $worksheets = 'worksheet'.$k;
					$$worksheets = $spreadsheet->createSheet();
					$$worksheets->setTitle($item['name']);
					// 写入表格数据
					$i = 0;
					$valLast = '';
					foreach ($item['titlestwo'] as $key => $title) {
						$$worksheets->setCellValue(($azs[$i]).'1', $title);
						foreach ($item['datatwo'][$key] as $n => $val) {
							$$worksheets->setCellValue(($azs[$i]).($n+2), $val);
							//附属表指定字段跨行合并
							if($key == $pran && $val == $valLast && $n>=1){
								$prange = ($azs[$i]).($n+1).':'.($azs[$i]).($n+2);
								$$worksheets->mergeCells($prange);
							}else if($key == 'order_sn'){
								$valLast = $val;
							}
						}
						++$i;
					}
				}
			}
			$filename = $filename."_".date('Y-m-d').".xlsx";

			header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");//告诉浏览器输出07Excel文件
			header("Content-Disposition: attachment;filename=".$filename);//告诉浏览器输出浏览器名称
			header('Cache-Control: max-age=0');


			$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
			$writer->save('php://output');
			//释放内存
			$spreadsheet->disconnectWorksheets();
			unset($spreadsheet);
		}catch(\Exception $e){
			echo $e->getMessage();die;
			return false;
		}
		return $filename;

	}
}
