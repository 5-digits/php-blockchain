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