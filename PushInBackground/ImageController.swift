//
//  ImageController.swift
//  PushInBackground
//
//  Created by haipt on 9/22/15.
//  Copyright © 2015 Framgia. All rights reserved.
//

import UIKit

class ImageController: UIViewController {
    @IBOutlet weak var mainImage: UIImageView!
    override func viewDidLoad() {
        super.viewDidLoad()
        mainImage.image = UIImage(named: "samsung.jpg")
    }

    override func didReceiveMemoryWarning() {
        super.didReceiveMemoryWarning()
        // Dispose of any resources that can be recreated.
    }

    func setImage(imageUrl: String?) {
        if imageUrl != nil {
            mainImage.image = UIImage(named: imageUrl!)
        }
    }
}
