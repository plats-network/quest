<?php

namespace App\Helpers\Dictionary;

class MiddleName
{
    public function dataScoreList()
    {
        // Đối với 100 đệm nữ phổ biến nhất

        $mid_female_pop = [
            'bảo 0.2906',
            'ngọc 0.2377',
            'thanh 0.6048',
            'phương 0.0668',
            'minh 2.3654',
            'kim 0.08',
            'khánh 0.2814',
            'quỳnh 0.005',
            'gia 2.3184',
            'như 0.0363',
            'anh 1.7481',
            'thảo 0.0064',
            'mỹ 0.0067',
            'yến 0.0047',
            'hồng 0.3364',
            'thùy 0.007',
            'tường 0.0623',
            'hoàng 4.1042',
            'thiên 1.3579',
            'tuyết 0.0055',
            'thu 0.0105',
            'mai 0.0224',
            'xuân 0.7826',
            'trúc 0.014',
            'thúy 0.0024',
            'bích 0.0104',
            'hà 0.0801',
            'ánh 0.0198',
            'hải 1.2511',
            'nhã 0.0108',
            'kiều 0.0104',
            'cẩm 0.1481',
            'diễm 0.0105',
            'lan 0.0066',
            'tú 0.0443',
            'vân 0.0426',
            'thủy 0.0144',
            'trâm 0.005',
            'trà 0.0085',
            'thị -1',
            'huỳnh 0.4075',
            'uyên 0.0107',
            'hoài 1.2162',
            'nhật 5.1423',
            'cát 0.0608',
            'tâm 0.1695',
            'huyền 0.0152',
            'hương 0.018',
            'linh 0.0706',
            'khả 0.1092',
            'ái 0.0177',
            'an 1.0206',
            'diệu 0.1006',
            'ngân 0.037',
            'thục 0.0106',
            'quế 0.0538',
            'kỳ 0.7218',
            'tuệ 0.0798',
            'đan 0.166',
            'thái 4.7217',
            'tố 0.0132',
            'lê 2.4273',
            'bội 0.0321',
            'đông 0.8571',
            'phi 2.4523',
            'hạnh 0.0452',
            'uyển -1',
            'song 0.2656',
            'nam 2.6087',
            'huệ 0.0511',
            'nguyệt 0.0116',
            'ý 0.0545',
            'mẫn 0.122',
            'nguyên 5.2',
            'phúc 10.3974',
            'châu 0.4685',
            'trang 0.0315',
            'lam 0.121',
            'tiểu 0.2213',
            'bình 2.6083',
            'hiền 0.2569',
            'lệ 0.0093',
            'băng 0.0093',
            'mộng -1',
            'đoan -1',
            'triệu 1.2083',
            'hiểu 0.383',
            'việt 7.8696',
            'thư 0.0112',
            'vy 0.046',
            'hạ 0.0247',
            'lâm 2.3026',
            'thụy 0.04',
            'hiếu 4.3562',
            'khải 3.411',
            'phụng 0.0704',
            'diệp 0.2143',
            'thy 0.0597',
            'khiết 0.1833',
            'hân 0.0536',
        ];

        // Đối với 100 đệm nam phổ biến nhất

        $mid_male_pop = [
            'minh 2.3654',
            'gia 2.3184',
            'hoàng 4.1042',
            'quốc 256.913',
            'anh 1.7481',
            'thanh 0.6048',
            'thành 328.9167',
            'tuấn 377.2',
            'tấn 438.375',
            'đức 157.1579',
            'quang 218.6154',
            'văn 394.1429',
            'bảo 0.2906',
            'nhật 5.1423',
            'đăng 81.5667',
            'duy 56.55',
            'thiên 1.3579',
            'ngọc 0.2377',
            'trung 96.15',
            'hữu 136.9286',
            'trọng 231.5',
            'phúc 10.3974',
            'tiến 506.6667',
            'chí 138.1',
            'khánh 0.2814',
            'hải 1.2511',
            'huy 97.1667',
            'đình 34.9091',
            'xuân 0.7826',
            'thái 4.7217',
            'công 177.8333',
            'trí 110.6667',
            'thế 100.8889',
            'phước 18.5217',
            'phú 49.6471',
            'hồng 0.3364',
            'nguyên 5.2',
            'trường 15.5417',
            'việt 7.8696',
            'vĩnh 17.125',
            'hoài 1.2162',
            'mạnh 108.1667',
            'thiện 14.45',
            'lê 2.4273',
            'phi 2.4523',
            'nam 2.6087',
            'phương 0.0668',
            'bá 221.5',
            'đại 103.5',
            'an 1.0206',
            'kim 0.08',
            'khôi 17.1429',
            'kiến 48.7143',
            'hiếu 4.3562',
            'nhựt 12.0385',
            'bình 2.6083',
            'cao 24',
            'vũ 16.8824',
            'hùng 84',
            'khải 3.411',
            'chấn 247',
            'huỳnh 0.4075',
            'viết 43.6',
            'hưng 194',
            'tùng 5.3889',
            'đông 0.8571',
            'phát 180',
            'kỳ 0.7218',
            'hạo 14.8333',
            'long 25.2857',
            'nhất 11',
            'lâm 2.3026',
            'vĩ 32.2',
            'thuận 7.85',
            'khang 7.8421',
            'vinh 24.6667',
            'sơn 4.3333',
            'nguyễn 6.7143',
            'quý 3.2857',
            'khắc 32.75',
            'trần 21.5',
            'cẩm 0.1481',
            'sỹ 119',
            'nhân 6.5',
            'triệu 1.2083',
            'như 0.0363',
            'tuần -1',
            'tường 0.0623',
            'phong 20',
            'tần -1',
            'dương 6.125',
            'đắc -1',
            'hào 43',
            'danh 17',
            'triều 3.4',
            'hà 0.0801',
            'tâm 0.1695',
            'hòa 7.8',
            'sĩ 35.5',
            'hoàn 1.4792',
        ];
        //Mảng chỉ số phân biệt giới tính của tên chính, mặc định là nam / nữ:

        // Đối với 100 tên nữ phổ biến nhất

        $forename_female_pop = [
            'anh 0.4168',
            'vy 0.0071',
            'ngọc 0.0349',
            'nhi 0.006',
            'hân 0.0106',
            'thư 0.0063',
            'linh 0.0434',
            'như 0.0055',
            'ngân 0.0095',
            'phương 0.1652',
            'thảo 0.0291',
            'my 0.0061',
            'trân 0.0061',
            'quỳnh 0.0188',
            'nghi 0.0256',
            'trang 0.0066',
            'trâm 0.0078',
            'an 0.8035',
            'thy 0.0079',
            'châu 0.0713',
            'trúc 0.0128',
            'uyên 0.0019',
            'yến 0.0057',
            'ý 0.0234',
            'tiên 0.0154',
            'mai 0.0085',
            'hà 0.0871',
            'vân 0.0131',
            'nguyên 1.4339',
            'hương 0.0078',
            'quyên 0.0099',
            'duyên 0.0078',
            'kim 0.0488',
            'trinh 0.0057',
            'thanh 0.4069',
            'tuyền 0.0179',
            'hằng 0.0108',
            'dương 0.6413',
            'chi 0.0175',
            'giang 0.3136',
            'tâm 1.1008',
            'lam 0.0492',
            'tú 1.306',
            'ánh 0.0299',
            'hiền 0.2148',
            'khánh 2.0549',
            'minh 6.0777',
            'huyền 0.0067',
            'thùy 0.0035',
            'vi 0.0165',
            'ly 0.0095',
            'dung 0.002',
            'nhung 0.002',
            'phúc 7.5168',
            'lan 0.0064',
            'phụng 0.0783',
            'ân 1.7271',
            'thi 0.0827',
            'khanh 0.6532',
            'kỳ 0.5221',
            'nga 0.005',
            'tường 0.8272',
            'thúy 0.0028',
            'mỹ 0.1194',
            'hoa 0.0335',
            'tuyết 0.0028',
            'lâm 2.7394',
            'thủy 0.0291',
            'đan 0.1518',
            'hạnh 0.0393',
            'xuân 0.0634',
            'oanh 0.0121',
            'mẫn 0.4114',
            'khuê 0.1151',
            'diệp 0.0299',
            'thương 0.1706',
            'nhiên 0.274',
            'băng 0.0246',
            'hồng 0.084',
            'bình 2.8223',
            'loan 0.0043',
            'thơ 0.0086',
            'phượng 0.0181',
            'mi 0.0046',
            'nhã 0.1981',
            'nguyệt -1',
            'bích 0.0105',
            'đào 0.037',
            'diễm -1',
            'kiều 0.0233',
            'hiếu 11.1813',
            'di 0.1282',
            'liên -1',
            'trà 0.071',
            'tuệ 0.2895',
            'thắm -1',
            'diệu 0.0435',
            'quân 15.8971',
            'nhàn 0.1691',
            'doanh 0.2647',
        ];

        // Đối với 100 đệm nam phổ biến nhất

        $forename_male_pop = [
            'huy 363.5882',
            'khang 164.7188',
            'bảo 65.2436',
            'minh 6.0777',
            'phúc 7.5168',
            'anh 0.4168',
            'khoa 93.6471',
            'phát 313',
            'đạt 311.7',
            'khôi 42.6984',
            'long 356.8571',
            'nam 130.6667',
            'duy 51',
            'quân 15.8971',
            'kiệt 1042.5',
            'thịnh 131.0667',
            'tuấn 270.1429',
            'hưng 156.6667',
            'hoàng 23.2278',
            'hiếu 11.1813',
            'nhân 41.381',
            'trí 284.8333',
            'tài 238.7143',
            'phong 396',
            'nguyên 1.4339',
            'an 0.8035',
            'phú 89.8235',
            'thành 121.5833',
            'đức 175.75',
            'dũng 341.25',
            'lộc 27.8511',
            'khánh 2.0549',
            'vinh 243.2',
            'tiến 119.1',
            'nghĩa 93.6667',
            'thiện 34.6875',
            'hào 272.25',
            'hải 54.9474',
            'đăng 69',
            'quang 333.3333',
            'lâm 2.7394',
            'nhật 41.087',
            'trung 130.1429',
            'thắng 296.3333',
            'tú 1.306',
            'hùng 411',
            'tâm 1.1008',
            'sang 12.6032',
            'sơn 131.8333',
            'thái 131.3333',
            'cường 196',
            'vũ 86.6667',
            'toàn 193.25',
            'ân 1.7271',
            'thuận 15.9333',
            'bình 2.8223',
            'trường -1',
            'danh 69.8889',
            'kiên 306.5',
            'phước 30',
            'thiên 10.6226',
            'tân 56.2',
            'việt 53.6',
            'khải 74.7143',
            'tín 254.5',
            'dương 0.6413',
            'tùng 252',
            'quý 9.5294',
            'hậu 8.2203',
            'trọng 161',
            'triết 105.75',
            'luân 410',
            'phương 0.1652',
            'quốc 129.6667',
            'thông 76',
            'khiêm 366',
            'hòa 4.4321',
            'thanh 0.4069',
            'tường 0.8272',
            'kha 10.129',
            'vỹ 94.3333',
            'bách 140',
            'khanh 0.6532',
            'mạnh 137',
            'lợi 8.1563',
            'đại 244',
            'hiệp 26',
            'đông 16.7143',
            'nhựt 45.8',
            'giang 0.3136',
            'kỳ 0.5221',
            'phi 4.5319',
            'tấn 106',
            'văn 3.6071',
            'vương 39.8',
            'công 95.5',
            'hiển 94',
            'linh 0.0434',
            'ngọc 0.0349',
            'vĩ 58',
        ];
    }

    public function getListFemalePop()
    {
        $mid_female_pop = [
            'bảo 0.2906',
            'ngọc 0.2377',
            'thanh 0.6048',
            'phương 0.0668',
            'minh 2.3654',
            'kim 0.08',
            'khánh 0.2814',
            'quỳnh 0.005',
            'gia 2.3184',
            'như 0.0363',
            'anh 1.7481',
            'thảo 0.0064',
            'mỹ 0.0067',
            'yến 0.0047',
            'hồng 0.3364',
            'thùy 0.007',
            'tường 0.0623',
            'hoàng 4.1042',
            'thiên 1.3579',
            'tuyết 0.0055',
            'thu 0.0105',
            'mai 0.0224',
            'xuân 0.7826',
            'trúc 0.014',
            'thúy 0.0024',
            'bích 0.0104',
            'hà 0.0801',
            'ánh 0.0198',
            'hải 1.2511',
            'nhã 0.0108',
            'kiều 0.0104',
            'cẩm 0.1481',
            'diễm 0.0105',
            'lan 0.0066',
            'tú 0.0443',
            'vân 0.0426',
            'thủy 0.0144',
            'trâm 0.005',
            'trà 0.0085',
            'thị -1',
            'huỳnh 0.4075',
            'uyên 0.0107',
            'hoài 1.2162',
            'nhật 5.1423',
            'cát 0.0608',
            'tâm 0.1695',
            'huyền 0.0152',
            'hương 0.018',
            'linh 0.0706',
            'khả 0.1092',
            'ái 0.0177',
            'an 1.0206',
            'diệu 0.1006',
            'ngân 0.037',
            'thục 0.0106',
            'quế 0.0538',
            'kỳ 0.7218',
            'tuệ 0.0798',
            'đan 0.166',
            'thái 4.7217',
            'tố 0.0132',
            'lê 2.4273',
            'bội 0.0321',
            'đông 0.8571',
            'phi 2.4523',
            'hạnh 0.0452',
            'uyển -1',
            'song 0.2656',
            'nam 2.6087',
            'huệ 0.0511',
            'nguyệt 0.0116',
            'ý 0.0545',
            'mẫn 0.122',
            'nguyên 5.2',
            'phúc 10.3974',
            'châu 0.4685',
            'trang 0.0315',
            'lam 0.121',
            'tiểu 0.2213',
            'bình 2.6083',
            'hiền 0.2569',
            'lệ 0.0093',
            'băng 0.0093',
            'mộng -1',
            'đoan -1',
            'triệu 1.2083',
            'hiểu 0.383',
            'việt 7.8696',
            'thư 0.0112',
            'vy 0.046',
            'hạ 0.0247',
            'lâm 2.3026',
            'thụy 0.04',
            'hiếu 4.3562',
            'khải 3.411',
            'phụng 0.0704',
            'diệp 0.2143',
            'thy 0.0597',
            'khiết 0.1833',
            'hân 0.0536',
        ];

        return $mid_female_pop;
    }
}
