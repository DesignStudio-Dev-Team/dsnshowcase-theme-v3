<?php
/**
 * Starter FAQ content, as product lines (top-level FAQ categories) with their
 * topics (child categories): Hot Tubs carries the 7 topics from the FAQ
 * planning sheet; Swim Spas, Saunas and Cold Plunge get a starter set; and
 * Company holds the dealer's own questions (hours, returns, privacy…), shown
 * on the FAQ landing page. Each FAQ has a quick answer (`s`) and an answer
 * (`l`, the post content).
 *
 * Imported by dsn_faq_seed() (inc/faq.php). Edit or delete them freely
 * under FAQs in the admin.
 *
 * @package dsnshowcase
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$dsn_faq_hot_tub_topics = array(
	array(
		'name' => 'Hot Tub Buyer Questions',
		'slug' => 'buyer',
		'desc' => 'Pricing, sizing, features and what to look for before you buy.',
		'faqs' => array(
			array(
				'q' => 'How much does a typical hot tub cost?',
				's' => 'Most quality hot tubs fall between $5,000 and $15,000 installed, with entry-level models starting lower and premium swim-spa hybrids costing more.',
				'l' => '<p>Price is driven mainly by size, jets, insulation, and brand. As a rough guide:</p><ul><li><strong>Entry level (2–4 seats):</strong> $4,000–$7,000</li><li><strong>Mid-range (5–6 seats):</strong> $7,000–$12,000</li><li><strong>Premium and swim spas:</strong> $12,000–$25,000+</li></ul><p>Budget for delivery, an electrical hookup, a pad or base, steps, and a cover lifter. Financing usually brings the monthly cost well below what most buyers expect.</p>',
			),
			array(
				'q' => 'What size hot tub should I buy?',
				's' => 'Plan on about 2 to 3 seats of space per regular user, then size up one level if you entertain often.',
				'l' => '<p>A 2–3 person tub suits couples, 4–5 seats fit a small family, and 6–7 seats suit regular entertaining. Also measure the delivery path (gates, side yards, doorways) and check that your pad or deck can handle the filled weight, often 4,000 to 6,000 pounds.</p><p>Visiting a showroom and sitting in a few models is the fastest way to confirm the size and seat layout feel right.</p>',
			),
			array(
				'q' => 'Is it worth paying more for a better hot tub?',
				's' => 'Usually, yes: better insulation, pumps and warranty lower your running costs and repair risk over 10+ years.',
				'l' => '<p>The biggest differences are not visible in a quick look: full-foam or high-density insulation, energy-efficient pumps, a stronger shell, and a longer warranty. These reduce monthly electricity use, keep the water quieter, and protect you from costly repairs.</p><p>Compare the total cost of ownership over ten years, not just the sticker price.</p>',
			),
			array(
				'q' => 'Should I buy from a local dealer or online?',
				's' => 'A local dealer gives you delivery, setup, water care help and warranty service in one place, which online sellers rarely match.',
				'l' => '<p>A hot tub is a heavy, plumbed, electrical appliance. A local dealer handles delivery and placement, walks you through startup, tests your water, and sends a technician when something needs fixing. Online sellers often leave delivery, wiring and warranty claims to you.</p>',
			),
		),
	),
	array(
		'name' => 'Hot Tub Installation & Delivery Questions',
		'slug' => 'installation-delivery',
		'desc' => 'Site prep, electrical, permits and what happens on delivery day.',
		'faqs' => array(
			array(
				'q' => 'What do I need to prepare before my hot tub arrives?',
				's' => 'You need a level, solid base, a dedicated electrical circuit, and a clear path from the driveway to the final spot.',
				'l' => '<p>Before delivery day:</p><ol><li>Pour or prepare a level pad (a reinforced concrete slab, pavers on compacted base, or a rated spa pad).</li><li>Have a licensed electrician install the correct dedicated circuit and GFCI disconnect.</li><li>Trim branches and move obstacles along the delivery path.</li><li>Confirm clearance for service access on at least one side.</li></ol>',
			),
			array(
				'q' => 'Do I need an electrician to install a hot tub?',
				's' => 'Yes. Most hot tubs require a dedicated 240V circuit and a GFCI disconnect installed by a licensed electrician.',
				'l' => '<p>Plug-and-play 120V models exist, but they heat slowly and run fewer jets at once. Most full-size hot tubs need a dedicated 240V, 50 or 60 amp circuit, a GFCI breaker, and a disconnect within sight of the tub. Local code decides the exact distance and permit rules, so book the electrician early.</p>',
			),
			array(
				'q' => 'Can a hot tub go on my deck?',
				's' => 'Sometimes, but only if the deck is engineered to carry the full weight of the tub, water and people.',
				'l' => '<p>A filled hot tub can weigh 4,000 to 6,000 pounds or more, concentrated on a small footprint. Most standard decks are built for much less. Have the deck checked or reinforced by a builder, or place the tub on a dedicated concrete pad next to it instead.</p>',
			),
			array(
				'q' => 'How long does hot tub delivery and setup take?',
				's' => 'Delivery and placement usually take 1–2 hours; the tub then needs 6–24 hours to fill and heat.',
				'l' => '<p>The crew positions the tub, removes packaging and checks the fit. Once it is placed and wired, filling takes about an hour and heating can take from 6 to 24 hours, depending on starting water temperature and the model. We will walk you through the controls and first water treatment before we leave.</p>',
			),
		),
	),
	array(
		'name' => 'Hot Tub Water Care & Maintenance Questions',
		'slug' => 'water-care-maintenance',
		'desc' => 'Keeping your water clear, balanced and safe with minimal effort.',
		'faqs' => array(
			array(
				'q' => 'How often should I change my hot tub water?',
				's' => 'Plan to drain and refill every 3 to 4 months, or sooner with heavy use.',
				'l' => '<p>Over time dissolved solids build up and the sanitizer can no longer keep up. A common rule of thumb: divide the tub volume in gallons by the average daily bathers, then divide by 3, to estimate days between changes. Most households land on every 90–120 days.</p><p>Clean the filter and wipe the shell during each refill.</p>',
			),
			array(
				'q' => 'How do I keep my hot tub water clear?',
				's' => 'Test the water weekly, keep sanitizer and pH in range, shower before use and rinse the filter regularly.',
				'l' => '<p>A simple routine:</p><ul><li>Test sanitizer and pH two to three times a week.</li><li>Shock the water weekly or after heavy use.</li><li>Rinse the filter every 2–4 weeks and deep clean it every quarter.</li><li>Keep the cover on and the water level correct.</li></ul><p>Bring a sample to our store for a free professional water test any time.</p>',
			),
			array(
				'q' => 'How often should I clean the hot tub filter?',
				's' => 'Rinse it every 2 to 4 weeks, soak it in filter cleaner every quarter and replace it about once a year.',
				'l' => '<p>A clean filter protects the pump and keeps the water clear. Rinse it with a garden hose, working between the pleats. Every three months soak it in a dedicated filter cleaner. Keep a spare so you can swap one in while the other dries.</p>',
			),
			array(
				'q' => 'Chlorine or bromine: which is better for a hot tub?',
				's' => 'Both work well. Bromine is gentler and holds up better in hot water; chlorine is fast-acting and easy to find.',
				'l' => '<p>Bromine stays effective at higher temperatures and has a milder smell. Chlorine acts faster and is usually cheaper. Pick one and stay with it, because switching requires a full drain and refill. Salt systems are another option that generates chlorine gently from salt in the water.</p>',
			),
		),
	),
	array(
		'name' => 'Hot Tub Ownership Questions',
		'slug' => 'ownership',
		'desc' => 'Running costs, warranties, covers and everyday ownership.',
		'faqs' => array(
			array(
				'q' => 'How much does it cost to run a hot tub each month?',
				's' => 'A well-insulated modern hot tub typically costs $15 to $40 a month in electricity, plus about $20 to $40 for chemicals.',
				'l' => '<p>Costs vary with the local electric rate, climate, insulation, how often you use it, and the temperature you keep it at. A quality cover and full-foam insulation make the biggest difference, so a less expensive tub can end up costing more to run over its lifetime.</p>',
			),
			array(
				'q' => 'How long does a hot tub last?',
				's' => 'With regular care, a quality hot tub lasts 15 to 20 years or longer.',
				'l' => '<p>Pumps, heaters and covers wear out sooner and can be replaced. The shell and cabinet last longest when the water is kept balanced, the cover is in good shape, and the tub is protected from direct hot sun and drying winds.</p>',
			),
			array(
				'q' => 'What does a hot tub warranty cover?',
				's' => 'Most warranties cover the shell structure, plumbing and electrical components for different lengths of time; wear items like covers and filters are usually shorter or excluded.',
				'l' => '<p>Read the warranty for coverage length per component (shell, surface, plumbing, equipment, cabinet), what counts as normal wear, and who performs service. Keeping the water balanced and the tub maintained is usually a condition of coverage, so keep your records.</p>',
			),
			array(
				'q' => 'How long does a hot tub cover last?',
				's' => 'Most covers last 5 to 7 years before the foam absorbs water and loses insulation value.',
				'l' => '<p>A heavy, waterlogged cover is the main sign it is time to replace it. A fresh cover can pay for itself in lower heating costs and is safer to lift. Use a cover lifter, avoid leaving it open in the sun, and condition the vinyl each season.</p>',
			),
		),
	),
	array(
		'name' => 'Hot Tub Health, Wellness & Usage Questions',
		'slug' => 'health-wellness-usage',
		'desc' => 'Benefits, safe temperatures and how to get the most out of every soak.',
		'faqs' => array(
			array(
				'q' => 'What are the health benefits of using a hot tub?',
				's' => 'Regular soaking can ease muscle and joint soreness, help you relax, and support better sleep.',
				'l' => '<p>Warm water and hydrotherapy jets increase circulation, loosen tight muscles, and reduce the stress response. Many owners also use their tub as a screen-free evening routine that supports better sleep. Talk to your doctor if you have a heart condition, are pregnant, or have other medical concerns.</p>',
			),
			array(
				'q' => 'What is the safe temperature for a hot tub?',
				's' => 'The maximum is 104°F (40°C); most people prefer 100–102°F.',
				'l' => '<p>Lower the temperature to 98–100°F for longer sessions or for children and older adults. Limit soaks to 15–30 minutes at the highest temperature, drink water, and exit slowly if you feel lightheaded.</p>',
			),
			array(
				'q' => 'How long should I stay in a hot tub?',
				's' => 'Most adults are comfortable for 15 to 30 minutes per session.',
				'l' => '<p>Start with shorter sessions and step out to cool down if you feel hot. Avoid alcohol, stay hydrated, and give young children shorter, cooler soaks with supervision.</p>',
			),
		),
	),
	array(
		'name' => 'Hot Tub Troubleshooting Questions',
		'slug' => 'troubleshooting',
		'desc' => 'Quick checks for the most common problems before you call service.',
		'faqs' => array(
			array(
				'q' => 'Why is my hot tub not heating?',
				's' => 'The most common causes are a dirty filter, low water level, a tripped GFCI breaker or a faulty heater.',
				'l' => '<p>Work through these checks in order:</p><ol><li>Make sure the water level covers the skimmer.</li><li>Clean or replace the filter.</li><li>Confirm the set temperature and that the tub is not in economy or sleep mode.</li><li>Reset the GFCI breaker.</li><li>Read any error code on the control panel.</li></ol><p>If it still will not heat, book a service call; do not open the equipment area yourself.</p>',
			),
			array(
				'q' => 'Why is my hot tub water cloudy?',
				's' => 'Cloudy water usually means a dirty filter, low sanitizer or unbalanced pH or alkalinity.',
				'l' => '<p>Test the water, correct the pH and alkalinity, shock the tub, and clean the filter. Run the filtration cycle longer for a day or two. If it does not clear in 48 hours, it may be time for a drain and refill.</p>',
			),
			array(
				'q' => 'What should I do if my hot tub jets are weak?',
				's' => 'Check that the jets are open, the water level is right and the filter is clean; weak flow is often an air lock or a clogged filter.',
				'l' => '<p>Rotate each jet face fully open, clean the filter, and top off the water. Loosen the union at the pump briefly to bleed trapped air (with the power off). Persistent low pressure can point to a failing pump, which a technician should look at.</p>',
			),
		),
	),
	array(
		'name' => 'Hot Tub Winter & Seasonal Questions',
		'slug' => 'winter-seasonal',
		'desc' => 'Cold-weather use, freeze protection and seasonal care.',
		'faqs' => array(
			array(
				'q' => 'Can I use my hot tub in the winter?',
				's' => 'Yes. Hot tubs are designed for year-round use and many owners say winter is the best time to soak.',
				'l' => '<p>A well-insulated tub holds its temperature in freezing weather. Keep the cover on between soaks, clear snow from the lid, keep the water level up and leave the tub powered on so freeze protection can work. A cover lifter and a clear, non-slip path to the tub make winter use safer.</p>',
			),
			array(
				'q' => 'Will my hot tub freeze if the power goes out?',
				's' => 'It can, but a full tub with a good cover usually holds off freezing for 24 to 48 hours.',
				'l' => '<p>If the power is out for an extended time, keep the cover sealed, add insulating layers if safe to do so, and consider draining the tub completely and blowing out the lines before a long cold snap. Ask your dealer about winterizing guidance specific to your model.</p>',
			),
			array(
				'q' => 'How do I close down my hot tub for the season?',
				's' => 'Drain it fully, blow out the plumbing lines, dry the shell and cover it securely.',
				'l' => '<p>Turn off the power, drain the tub, clean the filter, open all drains and jets, and use a wet-dry vacuum to remove standing water from the lines. Wipe the shell dry and secure the cover. Many owners simply keep the tub running all year, which is easier and keeps the equipment healthy.</p>',
			),
		),
	),
);

return array(
	array(
		'name'   => 'Hot Tubs',
		'slug'   => 'hot-tubs',
		'desc'   => 'Buying, installing, caring for and enjoying a hot tub.',
		'topics' => $dsn_faq_hot_tub_topics,
	),
	array(
		'name'   => 'Swim Spas',
		'slug'   => 'swim-spas',
		'desc'   => 'Swimming, exercise and relaxation in one backyard pool.',
		'topics' => array(
			array(
				'name' => 'Swim Spa Buyer Questions',
				'slug' => 'swim-spa-buyer',
				'desc' => 'Sizes, current systems and what a swim spa costs.',
				'faqs' => array(
					array(
						'q' => 'What is a swim spa?',
						's' => 'A swim spa is a long, deep pool with a powerful current, so you can swim in place, exercise and soak in one compact unit.',
						'l' => '<p>Most swim spas are 12 to 20 feet long. Jets or propellers create a current you swim against, so you never reach the wall. Many models add hydrotherapy seats, so the same unit works as a hot tub.</p><p>Because they hold less water than a pool, they heat faster and cost less to run, and they can be used year-round.</p>',
					),
					array(
						'q' => 'How much does a swim spa cost?',
						's' => 'Most swim spas cost between $20,000 and $50,000 installed, depending on length, current system and features.',
						'l' => '<p>Length and the type of current system drive most of the price. Also budget for a reinforced pad, electrical work, delivery (often with a crane) and a cover lifter.</p><p>Financing spreads the cost into a monthly payment, and our team can give you a full installed price for your yard.</p>',
					),
				),
			),
			array(
				'name' => 'Swim Spa Installation Questions',
				'slug' => 'swim-spa-installation',
				'desc' => 'Site preparation, delivery and power.',
				'faqs' => array(
					array(
						'q' => 'What kind of base does a swim spa need?',
						's' => 'A level, reinforced concrete pad sized for the full weight of the filled swim spa, which can exceed 20,000 pounds.',
						'l' => '<p>Most installations use a concrete pad at least 4 to 6 inches thick. Some owners set the swim spa partly or fully in-ground, which needs drainage and service access around the cabinet.</p><p>We review your site before delivery and give your contractor the exact specifications.</p>',
					),
					array(
						'q' => 'How is a swim spa delivered?',
						's' => 'Usually by truck and crane, which lifts it over the house or fence and sets it on the pad.',
						'l' => '<p>Because of their length, swim spas rarely fit through a side yard. A crane lift is common and usually takes under an hour. We plan the route, the crane position and any permits with you ahead of time.</p>',
					),
				),
			),
			array(
				'name' => 'Swim Spa Ownership Questions',
				'slug' => 'swim-spa-ownership',
				'desc' => 'Running costs, care and everyday use.',
				'faqs' => array(
					array(
						'q' => 'How much does it cost to run a swim spa?',
						's' => 'Many owners spend roughly $50 to $100 a month on electricity, depending on climate, size and how often it is used.',
						'l' => '<p>A tight-fitting insulated cover and good cabinet insulation make the biggest difference. Lowering the temperature slightly between uses also cuts costs.</p>',
					),
					array(
						'q' => 'Can I use a swim spa in the winter?',
						's' => 'Yes. Swim spas are heated and insulated for year-round use.',
						'l' => '<p>Keep the cover on when not in use, clear heavy snow from the lid and keep the water level up. Many owners find winter swims and soaks the highlight of the year.</p>',
					),
				),
			),
		),
	),
	array(
		'name'   => 'Saunas',
		'slug'   => 'saunas',
		'desc'   => 'Traditional and infrared saunas for home wellness.',
		'topics' => array(
			array(
				'name' => 'Sauna Buyer Questions',
				'slug' => 'sauna-buyer',
				'desc' => 'Traditional or infrared, sizes and costs.',
				'faqs' => array(
					array(
						'q' => 'What is the difference between a traditional and an infrared sauna?',
						's' => 'A traditional sauna heats the air with a stove; an infrared sauna warms your body directly with infrared panels at a lower air temperature.',
						'l' => '<p>Traditional saunas run hotter, typically 150 to 195°F, and let you pour water on the stones for steam. Infrared saunas run around 120 to 140°F and feel gentler, which some people find easier to stay in longer.</p><p>Try both in our showroom to find the heat you prefer.</p>',
					),
					array(
						'q' => 'How much does a home sauna cost?',
						's' => 'Home saunas typically range from about $3,000 for a compact model to $15,000 or more for a large outdoor sauna.',
						'l' => '<p>Size, indoor or outdoor use, the type of wood and the heater all affect the price. Outdoor barrel and cabin saunas also need a level base and an electrical connection.</p>',
					),
				),
			),
			array(
				'name' => 'Sauna Installation & Use Questions',
				'slug' => 'sauna-installation-use',
				'desc' => 'Where to put a sauna and how to use it.',
				'faqs' => array(
					array(
						'q' => 'Can I put a sauna indoors?',
						's' => 'Yes. Many saunas are designed for basements, garages or spare rooms; you need a level floor and the right electrical supply.',
						'l' => '<p>Infrared saunas often plug into a standard dedicated circuit, while traditional saunas usually need a 240V circuit installed by an electrician. Good ventilation keeps the room around the sauna dry.</p>',
					),
					array(
						'q' => 'How long should a sauna session last?',
						's' => 'Most people enjoy 10 to 20 minutes per session; start shorter and listen to your body.',
						'l' => '<p>Drink water before and after, cool down between rounds and leave if you feel dizzy or unwell. If you have a medical condition or are pregnant, ask your doctor before using a sauna.</p>',
					),
				),
			),
			array(
				'name' => 'Sauna Care Questions',
				'slug' => 'sauna-care',
				'desc' => 'Cleaning and looking after your sauna.',
				'faqs' => array(
					array(
						'q' => 'How do I clean my sauna?',
						's' => 'Wipe the benches after use, sit on a towel, and scrub the wood lightly with water and mild soap every few weeks.',
						'l' => '<p>Avoid harsh chemicals and varnish on the benches. Leave the door open after a session so the wood dries, and lightly sand any stains once a year.</p>',
					),
					array(
						'q' => 'How long does a sauna last?',
						's' => 'A well-kept sauna often lasts 15 to 20 years or more.',
						'l' => '<p>Quality wood, a covered location for outdoor models and a dry interior between uses add years to its life. Heaters and controls can be serviced or replaced if needed.</p>',
					),
				),
			),
		),
	),
	array(
		'name'   => 'Cold Plunge',
		'slug'   => 'cold-plunge',
		'desc'   => 'Cold water immersion tubs and how to use them.',
		'topics' => array(
			array(
				'name' => 'Cold Plunge Buyer Questions',
				'slug' => 'cold-plunge-buyer',
				'desc' => 'Choosing a cold plunge and what it costs.',
				'faqs' => array(
					array(
						'q' => 'What is a cold plunge?',
						's' => 'A cold plunge is a small tub that keeps water chilled, typically between 37 and 60°F, for short cold-water immersion.',
						'l' => '<p>A built-in chiller keeps the water at the temperature you set, and a filter and sanitizer keep it clean, so you don’t need bags of ice. Many owners pair a cold plunge with a hot tub or sauna for hot-cold contrast.</p>',
					),
					array(
						'q' => 'How much does a cold plunge cost?',
						's' => 'Cold plunges with a built-in chiller typically cost between $4,000 and $12,000.',
						'l' => '<p>Price depends on the size, how cold the chiller can go, insulation and whether it is rated for outdoor use. We can help you compare models in our showroom.</p>',
					),
				),
			),
			array(
				'name' => 'Cold Plunge Use & Safety Questions',
				'slug' => 'cold-plunge-use-safety',
				'desc' => 'How long, how cold and staying safe.',
				'faqs' => array(
					array(
						'q' => 'How long should I stay in a cold plunge?',
						's' => 'Beginners usually start with 1 to 3 minutes and build up slowly; there is no need to stay in long.',
						'l' => '<p>Start with warmer water, around 55 to 60°F, and shorter sessions. Breathe slowly, get out if you feel numb or dizzy, and warm up gradually afterward.</p><p>If you have a heart condition, high blood pressure or another medical condition, talk to your doctor before cold plunging.</p>',
					),
					array(
						'q' => 'Can I use a cold plunge with a hot tub or sauna?',
						's' => 'Yes. Many owners alternate between heat and a short cold plunge, often called contrast therapy.',
						'l' => '<p>A common routine is 10 to 15 minutes of heat followed by 1 to 3 minutes of cold, repeated a few times. Keep sessions comfortable and stay hydrated.</p>',
					),
				),
			),
			array(
				'name' => 'Cold Plunge Care Questions',
				'slug' => 'cold-plunge-care',
				'desc' => 'Keeping the water clean and the chiller running.',
				'faqs' => array(
					array(
						'q' => 'How often do I change the water in a cold plunge?',
						's' => 'With filtration and sanitizing, most owners change the water every 1 to 3 months.',
						'l' => '<p>Rinse off before plunging, keep the cover on, clean the filter regularly and test the water weekly. Cold water slows bacteria growth, but it still needs sanitizing.</p>',
					),
					array(
						'q' => 'Does a cold plunge need an electrical outlet?',
						's' => 'Yes. The chiller and filter need power, usually a standard dedicated outlet with GFCI protection.',
						'l' => '<p>Check the model’s requirements before delivery. Outdoor installations should use a weather-rated outlet placed a safe distance from the water.</p>',
					),
				),
			),
		),
	),
	// The dealer's own questions: shown on the FAQ landing page, not as a card.
	array(
		'name' => 'Company Questions',
		'slug' => 'company',
		'desc' => 'Questions about our store, our policies and how we work.',
		'faqs' => array(
			array(
				'q' => 'What are your store hours?',
				's' => 'Our showroom hours are shown at the top and bottom of every page, and we are happy to book a private appointment outside them.',
				'l' => '<p>Hours can change on holidays and during events, so call ahead if you are making a special trip. You can also book a wet test or a private showroom visit at a time that suits you.</p>',
			),
			array(
				'q' => 'What is your return policy?',
				's' => 'Unused accessories and water care products in their original packaging can usually be returned with a receipt; spas and saunas are covered by their sale agreement.',
				'l' => '<p>Contact us before returning an item so we can confirm it is eligible. Large products such as hot tubs, swim spas, saunas and cold plunges are often special-ordered, so the terms in your sale agreement apply.</p>',
			),
			array(
				'q' => 'How do you use my personal information?',
				's' => 'We only use the details you share to answer your request and serve you as a customer. We never sell your information.',
				'l' => '<p>Our full privacy policy explains what we collect, why and how to ask us to update or delete your details. It is linked at the bottom of every page.</p>',
			),
			array(
				'q' => 'Do you offer financing?',
				's' => 'Yes. We offer financing options to qualified buyers, and you can estimate your monthly payment on our website.',
				'l' => '<p>Use the financing calculator to see an estimated payment, then ask our team for current rates and promotions. Approval and terms depend on the lender.</p>',
			),
			array(
				'q' => 'Which areas do you deliver to?',
				's' => 'We deliver and install throughout our local service area; contact us with your ZIP code to confirm.',
				'l' => '<p>Delivery outside our usual area may be possible for an extra fee. Our team will confirm the delivery route, timing and any site preparation needed.</p>',
			),
			array(
				'q' => 'Do you service what you sell?',
				's' => 'Yes. Our service team handles warranty work, repairs and maintenance for the products we sell.',
				'l' => '<p>Request service through our website or by phone. Have your model and serial number handy so we can bring the right parts.</p>',
			),
		),
	),
);
