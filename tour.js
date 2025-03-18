//in assignment 2 we have to do with backend so to save time, i exports tours as array and will used in packages list, and details and checkout
// if we connect with backend in the future this array will come from backend database
const tours = [
    {
        id: "thailand",
        title: "Thailand - The Gateway to Southeast Aisa",
        image: "./assests/img/thailand.jpg",
        description: "Thailand is a Southeast Asian country and one of Asia’s most popular tourist destinations, with stunning beaches, vibrant nightlife, and a backpacker-friendly atmosphere. Sharing borders with Myanmar, Laos, Cambodia, and Malaysia, it is one of the top countries for exploring this region. Thailand is full of immersive experiences, whether you're seeking vibrant city life in Bangkok, historical sites in Ayutthaya, trekking through the jungles of Chiang Mai or enjoying the repose of the Phi Phi Islands.  One of the top beach holiday destinations in the world, Thailand is home to destinations like Phuket, Koh Phi Phi, Krabi, and Koh Samui. These offer breathtaking beaches, perfect for sunbathing, swimming, snorkeling, and water sports. Thailand also boasts an unforgettable nightlife, particularly in cities like Bangkok, Pattaya, and Phuket. From trendy rooftop bars with panoramic city views to vibrant night markets and nightclubs pumping out music until the early hours, there is something for everyone.Thailand is a country steeped in rich cultural heritage with a history spanning thousands of years. Visit its opulent temples, such as Wat Arun and Wat Phra Kaew, to witness intricate architecture and ornate decorations along with experiencing traditional Buddhist practices. Thailand is also a popular backpacker-friendly destination due to its affordability, accessibility, and welcoming atmosphere. Places like Bangkok's Khao San Road and Chiang Mai's Nimman Road are well-known hubs for backpackers.",
        price: 899,
        duration: "7 Days",
        besttime: "November to February (Cool and dry season)",
        locations: ["Bangkok", "Phuket", "Chiang Mai", "Pattaya"]
    },
    {
        id: "vietnam",
        title: "Vietnam - The Country of Natural Beauty and Scenic Vistas - Holidify Explorer Awards 2018 Winner",
        image: "./assests/img/vietnam.jpg",
        description: "Vietnam in south-eastern Asia is arguably one of the most beautiful countries on the continent offering a blend of natural beauty, rich history, and vibrant culture, making it an ideal destination for tourists. With a diverse range of landscapes, from stunning coastlines and towering mountains to lush deltas and vibrant cities Vietnam provides quite an unmatched experience. Vietnam is a land of contrasts. It is home to some of the most beautiful beach destinations in the world, like Da Nang, Nha Trang, or Phu Quoc Island, where crystal-clear waters and white sands create a tropical paradise. On the other hand, Vietnam's cities like Ho Chi Minh City and Hanoi are dynamic hubs with bustling markets, lively street life, and a vibrant food scene offering a vibrant blend of modernity and tradition.",
        price: 799,
        duration: "6 Days",
        besttime: "November to April (Dry season in the north), May to October (Dry season in the south)",
        locations: ["Hanoi", "Ho Chi Minh", "Da Nang", "Ha Long Bay"]
    },
    {
        id: "singapore",
        title: "Singapore - Singapore : A Recreation of Adventure",
        image: "./assests/img/singapore.jpg",
        description: "Best described as a microcosm of modern Asia, Singapore is a melting pot of culture and history, and an extravaganza of culinary delights. Officially known as the Republic of Singapore, it is both a city and a country located in Southeast Asia. One of Asia's most visited destinations, Singapore is best described as an amalgam of a fast-paced life and an off-the-back-street inheritance.Singapore is the quintessential cosmopolitan, having the highest religious diversity in any country. Spread 42 km (26 miles) east to west and 23 km (14 miles) north to south, today it boasts of the world's busiest port. Singapore has climbed to be one of Asia's hit-list destinations with its efficient and widespread transport system - whizzing in this country is just a matter of minutes!",
        price: 750,
        duration: "4 Days",
        besttime: "January to November",
        locations: ["Marina Bay Sands", "Sentosa Island", "Gardens by the Bay", "Universal Studios"]
    },
    {
        id: "indonesia",
        title: "Indonesia - Incredible Indonesia",
        image: "./assests/img/indonesia.jpg",
        description: "Made up of over seventeen thousand tiny islands sprawled across the Indian and Pacific Oceans, Indonesia is the world's largest island country. With over 100,000 kms of pristine shoreline, the adrenaline pumping Komodo Islands, spirited cities such as Yogyakarta in Java, to over 400 volcanoes 129 active volcanos), Indonesia is one of the best countries in south-east Asia. Indonesia's most famous island, Bali is the best place for any tourist who needs a week of absolute relaxation, fragrant cuisine, scenic beauty and a galore of culture and tradition. With its elaborate temples, endless coastline, scenic coral reefs, waterfalls and retreats, Bali is indeed, a place of leisure and idyll, and simultaneously, a place for the adventurous and the explorers.",
        price: 899,
        duration: "10 Days",
        besttime: "May to September (Dry season for most regions)",
        locations: ["Bali", "Jakarta", "Yogyakarta", "Komodo Island","Bromo"]
    },
    {
        id: "myanmar",
        title: "Myanmar - The golden lands of nature",
        image: "./assests/img/bagan.jpg",
        description: "Myanmar luxury tours lead you to elegant Myanmar (Burma), a relatively new destination in Asia to go deep to the fascinating cities to discover local culture with 5-star experience as well as out to the gorgeous countryside to gain authentic Burmese life with the friendly locals. Our Myanmar luxury tour packages are specifically designed for the sophisticated whose primary aim is to experience the very best that Myanmar tour packages can offer.Our Myanmar luxury private tours, cruise ships, and travel services are aimed at providing our customers authentic, unique & timed journeys, handpicked hotels, expert tour guides, the best restaurants, and all personalized services in every aspect for discerning visitors to Myanmar. They are the best of the best.",
        price: 849,
        duration: "8 Days",
        besttime: "November to Feburary (Cold season for most regions)",
        locations: ["Yangon", "Bagan", "Mandalay", "Inle Lake"]
    },
    {
        id: "cambodia",
        title: "Cambodia - A Country Rich in Heritage & Natural Beauty",
        image: "./assests/img/cambodia.jpg",
        description: "Cambodia is a country steeped in history. In spite of years and years of struggle, the country has emerged today as a nation with an infectious spirit seen in its people and a tourism business that is flourishing. Home of the famous Angkor Wat and numerous other temples, this country is intoxicating in its beauty, to say the least. Apart from the historical and the cultural, Cambodia is also urbane, boasting of beautiful Phnom Penh, its capital, and tonnes of restaurants serving delicious cuisine. Cambodia is an amalgamation of the old and the new and a gentle reminder that the two can indeed co-exist and do it graciously.",
        price: 750,
        duration: "4 Days",
        besttime: "November to April (Dry season)",
        locations: ["Siem Reap", "Phnom Penh", "Battambang"]
    },
    {
        id: "philippine",
        title: "Philippines - Gateway to hidden beaches and exotic islands",
        image: "./assests/img/philippines.jpg",
        description: "The Philippines is a nation studded with a myriad of islands in south-east Asia. It is home to many fantastic beaches, coral reefs and churches. It is also a very popular tourist destination offering plenty of options for tourists regarding nature, wildlife, adventure, entertainment and nightlife. The people are very warm and affable, and they will not hesitate to go an extra mile to see a smile on your face.",
        price: 780,
        duration: "6 Days",
        besttime: "November to April",
        locations: ["Manila", "Cebu", "Boracay", "Palawan"]
    },
    {
        id: "malaysia",
        title: "Malaysia - Asia in true sense!",
        image: "./assests/img/malaysia.jpg",
        description: "A potpourri of all things Asian, Malaysia is a country in Southeast Asia. An intriguing blend of diverse wildlife, idyllic islands, magnanimous mountains, rainforests, and rich culinary landscape makes it one of the most visited tourist places in Asia. The multi-cultural, multi-ethnic, and multi-lingual country is divided into two regions by the South China Sea - Peninsular Malaysia and East Malaysia. Surrounding these territorial boundaries are stunning islands and an array of landscapes. Due to the immensity of beaches and vivid marine life, Malaysia also offers excellent scuba diving spots. Once a part of the Federation of Malaysia, Singapore is linked with a narrow causeway and bridge which makes it a popular destination to combine during a trip to Malaysia.",
        price: 820,
        duration: "6 Days",
        besttime: " March to October (Dry season for West Coast), May to September (Dry season for East Coast) ",
        locations: ["Kuala Lumpur", "Penang", "Langkawi", "Borneo"]
    },
    {
        id: "laos",
        title: "Laos - The Land of Serenity and Bountiful Nature",
        image: "./assests/img/laos.jpg",
        description: "Sitting cosily in Southeast Asia, the Republic of Laos is a landlocked country with sparse population. Known for its spectacular landscape, the country comprises of lofty mountains, lush jungles, glistening rice fields and tea leaves covering the mountain surface. The remote tribal villages, ancient Buddhist caves, rich cultural heritage, cafe culture in cosmopolitans, elegant colonial architecture and peaceful stupas adds to the charm of this land of lotus-eaters.",
        price: 700,
        duration: "4 Days",
        besttime: "November to March (Dry and cool season) ",
        locations: ["Vientiane", "Luang Prabang", "Pakse"]
    },
    {
        id: "brunei",
        title: "Brunei Cultural Tour",
        image: "./assests/img/brunei.jpg",
        description: "Take a day to explore Bandar on this private tour. Avoid the crowds and get to know the city with your own personal guide. Visit local landmarks, shops and discover local life. Take a boat ride across the water and take in the picturesque scenery. Arrive at a local house and enjoy a light refreshment.Hotel pick up is available, including from Brunei International AirportA private tour means a personalized experience Travel in comfort, with air-conditioning and bottled waterLunch is included, so need to worry about packing your own. Read more about - Private Bandar Heritage & Water Village Tour",
        price: 650,
        duration: "3 Days",
        besttime: "January to May",
        locations: ["Bandar Seri Begawan", "Ulu Temburong National Park", "Royal Regalia Museum"]
    },
];
