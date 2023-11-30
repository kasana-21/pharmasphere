<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DrugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('drugs')->insert([
            ['name' => 'Paracetamol', 'description' => 'Paracetamol is a painkiller used to relieve mild to moderate pain and fever. It is often recommended as one of the first treatments for pain, as it\'s safe for most people to take and side effects are rare.', 'category_id' => 1],
            ['name' => 'Ibuprofen', 'description' => 'Ibuprofen is a painkiller available over the counter without a prescription. It\'s one of a group of painkillers called non-steroidal anti-inflammatory drugs (NSAIDs) and can be used to: ease mild to moderate pain – such as toothache, migraine and period pain', 'category_id' => 2],
            ['name' => 'Aspirin', 'description' => 'Aspirin is a common pain reliever that was originally derived from the bark of willow trees. It is also an anti-inflammatory and a blood thinner, which makes it useful in preventing blood clots that can cause heart attacks and strokes.', 'category_id' => 2],
            ['name' => 'Codeine', 'description' => 'Codeine is a painkiller. It\'s used to treat pain, for example after an operation or an injury. It\'s also used for long-standing pain when everyday painkillers, such as aspirin, ibuprofen and paracetamol, haven\'t worked.', 'category_id' => 3],
            ['name' => 'Morphine', 'description' => 'Morphine is a pain medication of the opiate family which is found naturally in a number of plants and animals. It acts directly on the central nervous system (CNS) to decrease the feeling of pain.', 'category_id' => 3],
            ['name' => 'Tramadol', 'description' => 'Tramadol is a narcotic-like pain relieving oral medicine that is used as a treatment for moderate to severe pain in adults. The extended-release-tablet formulation of this drug is used to treat moderate to severe chronic pain when treatment is needed around the clock.', 'category_id' => 4],
            ['name' => 'Diclofenac', 'description' => 'Diclofenac is a medicine that reduces inflammation and pain. It\'s used to treat aches and pains, as well as problems with joints, muscles and bones. These include: rheumatoid arthritis, osteoarthritis and gout.', 'category_id' => 4],
            ['name' => 'Naproxen', 'description' => 'Naproxen is a medicine that reduces inflammation and pain in joints and muscles. It\'s used to treat diseases of joints, such as rheumatoid arthritis, osteoarthritis and gout. It\'s also used for period pain and muscle and bone disorders, such as back pain and sprains and strains.', 'category_id' => 5],
            ['name' => 'Fentanyl', 'description' => 'Fentanyl is a powerful synthetic opioid analgesic that is similar to morphine but is 50 to 100 times more potent. It is a schedule II prescription drug, and it is typically used to treat patients with severe pain or to manage pain after surgery.', 'category_id' => 5],
            ['name' => 'Gabapentin', 'description' => 'Gabapentin is a prescription drug. It comes as an oral capsule, an immediate-release oral tablet, an extended-release oral tablet, and an oral solution. Gabapentin oral capsule is available as the brand-name drug Neurontin. It\'s also available as a generic drug.', 'category_id' => 5],
            ['name' => 'Oxycodone', 'description' => 'Oxycodone is a narcotic medication used to relieve moderate to severe pain. OxyContin is a brand of timed-release oxycodone, made by Purdue Pharma, that works for up to 12 hours.', 'category_id' => 6],
            ['name' => 'Hydrocodone', 'description' => 'Hydrocodone is a prescription painkiller from the opiate family. It works by attaching to receptors in your brain to decrease pain perception. Hydrocodone is most often combined with acetaminophen to make a prescription painkiller such as Vicodin or Lortab.', 'category_id' => 6],
            ['name' => 'Methadone', 'description' => 'Methadone is a prescription drug. It’s an opioid, which makes it a controlled substance. That means it can only be used under a doctor’s close supervision.', 'category_id' => 7],
            ['name' => 'Oxymorphone', 'description' => 'Oxymorphone is a prescription medication. It comes in four forms: immediate-release tablet, extended-release tablet, immediate-release capsule, and extended-release capsule. All forms are taken by mouth.', 'category_id' => 7],
            ['name' => 'Hydromorphone', 'description' => 'Hydromorphone is a prescription medication. It comes in four forms: immediate-release tablet, extended-release tablet, immediate-release capsule, and extended-release capsule. All forms are taken by mouth.', 'category_id' => 3],
            ['name' => 'Morphine', 'description' => 'Morphine is a pain medication of the opiate family which is found naturally in a number of plants and animals. It acts directly on the central nervous system (CNS) to decrease the feeling of pain.', 'category_id' => 3],
            ['name' => 'Tramadol', 'description' => 'Tramadol is a narcotic-like pain relieving oral medicine that is used as a treatment for moderate to severe pain in adults. The extended-release-tablet formulation of this drug is used to treat moderate to severe chronic pain when treatment is needed around the clock.', 'category_id' => 4],
            ['name' => 'Diclofenac', 'description' => 'Diclofenac is a medicine that reduces inflammation and pain. It\'s used to treat aches and pains, as well as problems with joints, muscles and bones. These include: rheumatoid arthritis, osteoarthritis and gout.', 'category_id' => 4],
            ['name' => 'Naproxen', 'description' => 'Naproxen is a medicine that reduces inflammation and pain in joints and muscles. It\'s used to treat diseases of joints, such as rheumatoid arthritis, osteoarthritis and gout. It\'s also used for period pain and muscle and bone disorders, such as back pain and sprains and strains.', 'category_id' => 5],
            ['name' => 'Fentanyl', 'description' => 'Fentanyl is a powerful synthetic opioid analgesic that is similar to morphine but is 50 to 100 times more potent. It is a schedule II prescription drug, and it is typically used to treat patients with severe pain or to manage pain after surgery.', 'category_id' => 5],
            ['name' => 'Gabapentin', 'description' => 'Gabapentin is a prescription drug. It comes as an oral capsule, an immediate-release oral tablet, an extended-release oral tablet, and an oral solution. Gabapentin oral capsule is available as the brand-name drug Neurontin. It\'s also available as a generic drug.', 'category_id' => 5],
        ]);
    }
}
