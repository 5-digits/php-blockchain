#php-blockchain
Bu repo'nun amacı blockchain yaklaşımı ile toplu şekilde duran verilerin şifrelenip güvenle saklanmasını anlatmak. Anlatımlar PHP üzerinden ve İstiklal Marşı'nın 2 kıtasının şifrelenmesiyle yapıldı.

**SHA256**: Belirli bir string'i şifreleyerek, (metin uzunluğu ne olursa olsun) 64 bitlik bir string döndüren kırpma algoritması
**Block**: En küçük veri grubu, örneğin: bir insanın bilgileri, istiklal marşının her kıtası
**BlockChain**: Blocklardan meydana gelen zincir.

### Blocklar hakkında
Verileri saklarken veriyi, blocklara ayırdığımızı söylemiştik. Bu block'ların 5 tane değeri var:
**id**: İki bloğu bir birinden ayırabilmek için yaptığımız indis.
**payload**: Bloğun içinde olacak verimiz
**hash**: Bloğun JSON karşılığının SHA256 ile şifrelenmiş hali
**prevHash**: Blokları birleştirmek için önceki hash'e ihtiyacımız var onun için bunu belirtmeliyiz. İlk blok için 64 tane sıfır sayısı.
**nonce**: Bloğa kaçıncı defada ulaştığımızı belirten indis.

### Mining hakkında

Aslında Bitcoin kısmında duyduğumuz bir kavram ve Blockchain'i kullanmadan önce bilmiyordum. Şöyle izah edeyim, Bizler Hash'i belirli bir kurala göre yazılmısını istiyoruz örneğin 64 karakterlik bu string'in son 4 harfinin abcd  olmasını isteyebiliriz, işte bu tip bir string'i elde etmek için yaptığımız işleme *mining* deniyor. Bunu yapana kadar ki yapılan denemeye de *nonce* diyoruz. Eğer nonce değerini her bulamayışımızda arttırmasaydık sürekli aynı şifreyi elde ederdik bu da sistemi anlamsız kılardı.
### İstiklal Marşının BlockChain ile Şifrelenmesi
İstiklal marşının iki kıtasını şifreleyecek olursak,

	$blockchain = new Blockchain;
diyerek sınıfımızı başlatıyoruz, sınıfımız *src/* klasörünün altındadır.
Daha sonra şifrelemek istediğimiz veriyi addBlock metodu yardımıyla veriyoruz. Bu fonksiyonun parametresi bizim payload'ımız oluyor.

	 $blockchain->addBlock(file_get_contents('./istiklalmarsi/kita1.txt'));
	 $blockchain->addBlock(file_get_contents('./istiklalmarsi/kita2.txt'));

Ve Hash'de belirli bir kural belirtmek gerektiğinden isteğe bağlı olarak  *acceptanceRule*  metodunu overwrite etmeliyiz. Örneğin ilk 4 hanenin 0000 olduğu durumlarda block'ların ✓valid✓ olmasını istiyorsak, 

	$blockchain->acceptanceRule = function($sha256){
		if( substr($sha256,4) == "0000" ) return true;
		return false;
	}
yazarız. Bu belirleyeceğiniz kural ne kadar zor olursa,  nonce değeri o kadar büyük olur ve zamandan kaybedersiniz. Belki de *maxNonce* değerini bile aşabilirsiniz, böyle bir durumda sistem doğru bir şekilde çalışmaz.
*maxNonce* değeri default olarak 1000000'a ayarlanmıştır.

## Çıktının üretilmesi

	$blockchain->dump();

ile çıktıya erişebiliriz, çıktıya erişme süreniz belirleyeceğiniz Hash kuralına, bilgisayarınız özelliklerine göre değiştir. Eğer PHP'nin bize vereceği Array sonucu, JSON'a çevirirsek (lütfen example/dump.json'a bakın), verinin bloklar halinde olduğunu ve her bloğun önceki bloğa prevHash ile bağlandığını görürüz. Örnekteki block değeri de bu sayede anlamsız kalıyor.

## Sonuç Olarak

[sonuc kısmı yazılacak, işler burada karmaşıkalşıyor]