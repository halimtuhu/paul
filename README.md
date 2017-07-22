# paul's website

===
needs.txt

Paul's Website
- Languages
	- Swahili
	- English

- News / habari
	politic	/ siasa
	entertaiment / burudani
	health / afya
	sport / michezo
	news paper / magazeti


- Academics / Taaluma
	Primary Education / Elimu ya msingi
	Secondary Education / elimu ya sekondari / upili
		O-level (like junior) / kidato cha kwanza hadi cha nne
		A-level (like senior) / kidato cha tano na sita
	High Education / elimnu ya juu
		admin upload their own
		user upload thier own with aprove from admin

- E Commerce /
	sell (uza) and buy (nunua)

- Discus Forum / Chumba cha majadilano (linked to news)
	people can make a new forum about some topic to discus

- Scholarship / ufadhili


reference for news part
	www.livefoot.fr

===

###Installation instruction
Setelah clone jalankan hal2 di bawah ini dulu
1. command -> "composer install"
2. command -> "copy .env.example .env"
3. command -> "php artisan key:generate"
4. buat database denngan nama "paul"
5. configurasi .env
6. command -> "php artisan migrate:refresh --seed"
7. done

Untuk login ke admin langsung ke /admin-paul
email -> halimlebah@gmail.com
pass -> ngktau
